<?php

namespace App\Author;

class AuthorEntity
{
    private string $name;
    private string $surname;
    private ?string $patronymic = null;

    public function __construct(
        string $name,
        string $surname,
        ?string $patronymic = null,
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->patronymic = $patronymic;
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
}
