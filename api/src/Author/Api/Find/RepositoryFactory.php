<?php

declare(strict_types=1);

namespace App\Author\Api\Find;

use App\Api\Find\Repository;
use App\Author\AuthorEntity;
use Doctrine\ORM\EntityManagerInterface;

class RepositoryFactory
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function fromInput(int $page, int $limit): Repository
    {
        $qb = $this->em->getRepository(AuthorEntity::class)->createQueryBuilder('a');
        return (new Repository($qb))
            ->setPagination(($page - 1) * $limit, $limit);
    }
}
