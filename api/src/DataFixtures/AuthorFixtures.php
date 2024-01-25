<?php

namespace App\DataFixtures;

use App\Author\AuthorEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('uk_UA');

        for ($i = 1; $i <= 50; $i++) {
            $author = new AuthorEntity(
                name: $faker->firstName(),
                surname: $faker->lastName(),
                patronymic: $faker->boolean ? $faker->firstNameMale() : null,
            );
            $manager->persist($author);
        }
        $manager->flush();
    }
}
