<?php

declare(strict_types=1);

namespace App\Book\Api;

use App\Author\Api\DataBuilder as AuthorDataBuilder;
use App\Book\BookEntity;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DataBuilder
{
    public function __construct(
       private readonly AuthorDataBuilder $authorDataBuilder,
       private readonly ContainerBagInterface $containerBag,
    ) {
    }

    /**
     * @param BookEntity[] $authors
     * @return array
     */
    public function books(array $authors): array
    {
        return array_map(fn($author) => $this->book($author), $authors);
    }

    public function book(BookEntity $book): array
    {
        return [
            'name'              => $book->getName(),
            'short_description' => $book->getShortDescription(),
            'authors'           => $this->authorDataBuilder->authors($book->getAuthors()->toArray()),
            'image'             => $this->buildImageUrl($book->getImage())
        ];
    }

    private function buildImageUrl($image): string
    {
        return $this->containerBag->get('app.storage_base_url') . $image;
    }
}
