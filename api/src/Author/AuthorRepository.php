<?php

namespace App\Author;

use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<AuthorEntity>
 */
class AuthorRepository extends EntityRepository
{
    public function getAll(): array
    {
        return $this->findAll();
    }
}
