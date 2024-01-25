<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Author\AuthorEntity;
use App\Book\BookEntity;
use App\Book\ImageUploader;
use App\Kernel;
use App\Utils\Uploader\FileUploader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(
        private readonly ImageUploader $imageUploader,
        private readonly Kernel        $kernel,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker   = Factory::create('uk_UA');
        $authors = $manager->getRepository(AuthorEntity::class)->findAll();

        $imagesDir = $this->kernel->getDataFixturesPath() . '/images';
        $images   = array_filter(scandir($imagesDir), fn($item) => is_file($imagesDir . '/' . $item));

        for ($i = 1; $i <= 150; $i++) {
            $uploadedFile = new UploadedFile($imagesDir . '/' . $faker->randomElement($images), 'image.png');
            $bookImage   = $this->imageUploader->upload($uploadedFile);
            $book        = new BookEntity(
                name            : $faker->title(),
                image           : $bookImage->getFilePath(),
                publishDate     : $faker->dateTimeBetween('-20 years'),
                authors         : $faker->randomElements($authors, random_int(1, 4)),
                shortDescription: $faker->boolean(70) ? $faker->text() : null
            );
            $manager->persist($book);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixtures::class
        ];
    }
}
