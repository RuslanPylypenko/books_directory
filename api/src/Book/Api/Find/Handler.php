<?php

declare(strict_types=1);

namespace App\Book\Api\Find;

use App\Book\Api\DataBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

class Handler extends AbstractController
{
    private const PER_PAGE = 12;

    public function __construct(
        private readonly RepositoryFactory $repositoryFactory,
        private readonly DataBuilder $dataBuilder,
    ) {
    }

    #[Route('/books', methods: ['GET'])]
    public function handle(
        #[MapQueryParameter(name: 'page')] int $page = 1,
        #[MapQueryParameter(name: 'author_surname')] ?string $author = null,
    ): Response
    {
        $repository = $this->repositoryFactory->fromInput($page, self::PER_PAGE, $author);

        return $this->json([
            'list'  => $this->dataBuilder->books($repository->result()),
            'total' => $repository->total(),
        ]);
    }
}
