<?php

namespace App\Author\Command\Create;

use App\Author\AuthorEntity;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function handle(Command $command): void
    {
        $author = new AuthorEntity(
            $command->name,
            $command->surname,
            $command->patronymic,
        );

        $this->em->persist($author);
        $this->em->flush();
    }
}
