<?php

declare(strict_types=1);

namespace App\Book\Api\Update;

use App\Api\Exception\ApiException;
use App\Author\AuthorEntity;
use App\Book\Api\DataBuilder;
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
        private readonly DataBuilder $dataBuilder,
    ) {
    }

    #[Route('/books/{id}/edit', methods: ['POST'])]
    public function handle(UpdateRequest $request, int $id): Response
    {
        if (null === $book = $this->em->getRepository(BookEntity::class)->find($id)) {
            throw new ApiException('Book entity not found', 404);
        }

        try {
            $image = $this->imageUploader->upload($request->image);
        } catch (FilesystemException $exception) {
            throw new ApiException('Image can`t uploaded.');
        }

        if (null === $authors = $this->em->getRepository(AuthorEntity::class)->findByIds($request->authors)) {
            throw new ApiException('Authors not found.');
        }

        $book->setName($request->name);
        $book->setAuthors($authors);
        $book->setPublishDate(new \DateTime($request->publishDate));
        $book->setImage($image->getFilePath());
        $book->setShortDescription($request->shortDescription);

        $this->em->persist($book);

        $this->em->flush();

        return $this->json(
            $this->dataBuilder->book($book)
        );
    }
}
