<?php

declare(strict_types=1);

namespace App\Api\Find;

use Doctrine\ORM\QueryBuilder;

class Repository
{
    private ?int $offset = null;
    private ?int $count  = null;

    public function __construct(
        private readonly QueryBuilder $qb
    ) {
    }

    public function setPagination(?int $offset, ?int $count): self
    {
        $this->offset = $offset;
        $this->count  = $count;

        return $this;
    }

    public function result(): array
    {
        return $this->queryBuilder()->getQuery()->getResult();
    }

    public function total(): int
    {
        $query = clone $this->qb;

        $query->setFirstResult(null);
        $query->setMaxResults(null);

        return $query->select(sprintf('COUNT(%s)', $query->getRootAliases()[0]))
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function queryBuilder(): QueryBuilder
    {
        $this->qb->setFirstResult($this->offset);
        $this->qb->setMaxResults($this->count);

        return $this->qb;
    }
}
