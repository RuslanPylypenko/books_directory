<?php

declare(strict_types=1);

namespace App\Book\Api\Find;

use App\Api\InputInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FindRequest implements InputInterface
{
    #[Assert\NotBlank(allowNull: true)]
    public ?string $search = null;

    #[Assert\Collection(
        fields: [
            'limit' => new Assert\Required([
                new Assert\NotBlank,
                new Assert\Type('integer'),
            ]),
            'offset' => new Assert\Required([
                    new Assert\NotBlank,
                    new Assert\Type('integer'),
                ]
            ),
        ],
    )]
    public array $result = [
        'limit' => null,
        'offset' => null,
    ];
}