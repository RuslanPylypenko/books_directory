<?php

declare(strict_types=1);

namespace App\Book\Api\Create;

use App\Api\Exception\ApiException;
use App\Author\AuthorEntity;
use App\Book\BookEntity;
use App\Book\ImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use League\Flysystem\FilesystemException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Handler extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly ImageUploader $imageUploader,
    ) {
    }

    #[Route('/books', methods: ['POST'])]
    public function handle(CreateRequest $request): Response
    {
        try {
            $image = $this->imageUploader->upload($request->image);
        } catch (FilesystemException $exception) {
            throw new ApiException('Image can`t uploaded.');
        }

        if (null === $authors = $this->em->getRepository(AuthorEntity::class)->findByIds($request->authors)) {
            throw new ApiException('Authors not found.');
        }

        $author = new BookEntity(
            $request->name,
            $image->getFilePath(),
            new \DateTime($request->publishDate),
            $authors,
            $request->shortDescription
        );

        $this->em->persist($author);
        $this->em->flush();

        return $this->json([]);
    }
}
