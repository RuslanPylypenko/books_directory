<?php

namespace App\Author;

use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<AuthorEntity>
 */
class AuthorRepository extends EntityRepository
{
    private const DEFAULT_PER_PAGE = 12;

}
