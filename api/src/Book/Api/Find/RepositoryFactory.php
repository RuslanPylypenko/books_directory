<?php

declare(strict_types=1);

namespace App\Book\Api\Find;

use App\Api\Find\Repository;
use App\Author\AuthorEntity;
use App\Book\BookEntity;
use Doctrine\ORM\EntityManagerInterface;

class RepositoryFactory
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function fromInput(int $page, int $limit, ?string $search = null): Repository
    {
        $qb = $this->em->getRepository(BookEntity::class)->createQueryBuilder('b')
            ->join('b.authors', 'a');

        if (!empty($search)) {
            $qb->where($qb->expr()->like('a.surname', ':search'))
                ->setParameter('search', "%{$search}%");
        }

        return (new Repository($qb))
            ->setPagination(($page - 1) * $limit, $limit);
    }
}
