<?php

declare(strict_types=1);

namespace App\Book;

use App\Author\AuthorEntity;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping;

#[Mapping\Entity(repositoryClass: BookRepository::class)]
#[Mapping\Table(name: 'book')]
#[Mapping\ChangeTrackingPolicy('DEFERRED_EXPLICIT')]
class BookEntity
{
    #[Mapping\Id]
    #[Mapping\Column(type: Types::INTEGER, options: ['unsigned' => true])]
    #[Mapping\GeneratedValue]
    private ?int $id = null;

    #[Mapping\Column(name: 'name', type: Types::STRING, length: 255)]
    private string $name;

    #[Mapping\Column(name: 'short_description', type: Types::TEXT, length: 900, nullable: true)]
    private ?string $shortDescription;

    #[Mapping\Column(name: 'image', type: Types::STRING, length: 255)]
    private string $image;

    #[Mapping\Column(name: 'publish_date', type: Types::DATETIME_MUTABLE, length: 255)]
    private DateTime $publishDate;

    #[Mapping\JoinTable(name: 'book_author')]
    #[Mapping\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[Mapping\InverseJoinColumn(name: 'author_id', referencedColumnName: 'id')]
    #[Mapping\ManyToMany(targetEntity: AuthorEntity::class)]
    private Collection $authors;

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
        $this->authors = new ArrayCollection($authors);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getPublishDate(): DateTime
    {
        return $this->publishDate;
    }

    public function setPublishDate(DateTime $publishDate): void
    {
        $this->publishDate = $publishDate;
    }

    /**
     * @return Collection<AuthorEntity>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function setAuthors(array $authors): void
    {
        $this->authors = new ArrayCollection($authors);
    }
}
