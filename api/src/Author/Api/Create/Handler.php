<?php

namespace App\Author\Command\Create;

use App\Author\AuthorEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Handler extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    #[Route('/ebay/product/find/', methods: ['POST'])]
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
