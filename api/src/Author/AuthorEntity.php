<?php

namespace App\Author;

use App\Book\BookEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping;

#[Mapping\Entity(repositoryClass: AuthorRepository::class)]
#[Mapping\Table(name: 'author')]
#[Mapping\Index(columns: ['surname'], name: 'surname')]
#[Mapping\ChangeTrackingPolicy('DEFERRED_EXPLICIT')]
class AuthorEntity
{
    #[Mapping\Id]
    #[Mapping\Column(type: Types::INTEGER, options: ['unsigned' => true])]
    #[Mapping\GeneratedValue]
    private ?int $id = null;

    #[Mapping\Column(name: 'name', type: Types::STRING, length: 255)]
    private string $name;

    #[Mapping\Column(name: 'surname', type: Types::STRING, length: 255)]
    private string $surname;

    #[Mapping\Column(name: 'patronymic', type: Types::STRING, length: 255, nullable: true)]
    private ?string $patronymic = null;

    #[Mapping\ManyToMany(targetEntity: BookEntity::class, mappedBy: "authors")]
    private Collection $books;

    public function __construct(
        string $name,
        string $surname,
        ?string $patronymic = null,
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;

        $this->books = new ArrayCollection([]);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }
}
