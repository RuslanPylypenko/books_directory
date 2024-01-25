<?php

declare(strict_types=1);

namespace App\Book\Observer;

use App\Book\BookEntity;
use App\Book\ImageUploader;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::preUpdate, entity: BookEntity::class)]
class Book
{
    public function __construct(
        private readonly ImageUploader $imageUploader,
    ) {
    }

    public function preUpdate(BookEntity $entity, PreUpdateEventArgs $args): void
    {
        if ($args->hasChangedField('image')) {
            $this->imageUploader->remove($args->getOldValue('image'));
        }
    }
}
