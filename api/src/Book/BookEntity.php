<?php

namespace App\Book;

use App\Author\AuthorEntity;
use DateTime;

class BookEntity
{
    private string $name;
    private ?string $shortDescription = null;
    private string $image;
    private DateTime $publishDate;

    /** @var AuthorEntity[] */
    private array $authors;

    /**
     * @param AuthorEntity[] $authors
     */
    public function __construct(
        string $name,
        string $image,
        DateTime $publishDate,
        array $authors,
        ?string $shortDescription = null,
    ) {
        $this->name = $name;
        $this->image = $image;
        $this->publishDate = $publishDate;
        $this->shortDescription = $shortDescription;
        $this->authors = $authors;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getPublishDate(): DateTime
    {
        return $this->publishDate;
    }

    /**
     * @return AuthorEntity[]
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }
}