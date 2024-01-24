<?php

namespace App\Book;

use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<BookEntity>
 */
class BookRepository extends EntityRepository
{
    public function getAll(): array
    {
        return $this->findAll();
    }
}
