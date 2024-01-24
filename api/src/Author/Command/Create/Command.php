<?php
namespace App\Author\Command\Create;

use Webmozart\Assert\Assert;

class Command
{
    public function __construct(
        public string $name,
        public string $surname,
        public ?string $patronymic = null
    ) {
        Assert::notEmpty($this->name);
        Assert::minLength($this->surname, 3);
    }
}