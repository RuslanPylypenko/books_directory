<?php

declare(strict_types=1);

namespace App\Author\Api\Create;

use App\Author\AuthorEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Handler extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route('/authors', methods: ['POST'])]
    public function handle(CreateRequest $request): Response
    {
        $author = new AuthorEntity(
            $request->name,
            $request->surname,
            $request->patronymic,
        );

        $this->em->persist($author);
        $this->em->flush();

        return $this->json([], Response::HTTP_CREATED);
    }
}
