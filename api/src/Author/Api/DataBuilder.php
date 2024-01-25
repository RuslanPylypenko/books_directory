<?php

namespace App\Author\Api;

use App\Author\AuthorEntity;

class DataBuilder
{
    /**
     * @param AuthorEntity[] $authors
     * @return array
     */
    public function authors(array $authors): array
    {
        return array_map(fn($author) => $this->author($author), $authors);
    }

    public function author(AuthorEntity $author): array
    {
        return [
            'name'       => $author->getName(),
            'surname'    => $author->getSurname(),
            'patronymic' => $author->getPatronymic(),
        ];
    }
}
