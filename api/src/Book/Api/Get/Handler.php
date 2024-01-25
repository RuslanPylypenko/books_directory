<?php

declare(strict_types=1);

namespace App\Book\Api\Get;

use App\Api\Exception\ApiException;
use App\Book\Api\DataBuilder;
use App\Book\BookEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Handler extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly DataBuilder $dataBuilder,
    ) {
    }

    #[Route('/books/{id}', methods: ['GET'])]
    public function handle(int $id): Response
    {
        if (null === $book = $this->em->getRepository(BookEntity::class)->find($id)) {
            throw new ApiException('Book entity not found', 404);
        }

        return $this->json(
            $this->dataBuilder->book($book)
        );
    }
}
