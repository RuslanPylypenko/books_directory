<?php

declare(strict_types=1);

namespace App\Author;

use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<AuthorEntity>
 */
class AuthorRepository extends EntityRepository
{
    /**
     * @param AuthorEntity[] $ids
     */
    public function findByIds(array $ids): array
    {
        $qb = $this->createQueryBuilder('a');
        $qb->where($qb->expr()->in('a.id', ':ids'))
            ->setParameter('ids', $ids);

        return $qb->getQuery()->getResult();
    }
}
