<?php

declare(strict_types=1);

namespace App\Author\Api\Create;

use App\Api\InputInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Request implements InputInterface
{
    #[Assert\NotBlank, Assert\Length(min: 1, max: 255)]
    public string $name;

    #[Assert\NotBlank, Assert\Length(min: 3, max: 255)]
    public string $surname;

    #[Assert\NotBlank(allowNull: true), Assert\Length(max: 255)]
    public ?string $patronymic = null;
}
