<?php

declare(strict_types=1);

namespace App\Book\Api\Create;

use App\Api\InputInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\SerializedPath;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRequest implements InputInterface
{
    #[Assert\NotBlank, Assert\Length(min: 1, max: 255)]
    public string $name;

    #[Assert\NotBlank(allowNull: true), Assert\Length(min: 1, max: 900)]
    #[SerializedPath('[short_description]')]
    public ?string $shortDescription = null;

    #[Assert\NotBlank, Assert\Image(maxSize: '2m', mimeTypes: ["image/jpeg", "image/jpg", "image/png"])]
    public UploadedFile $image;

    #[Assert\NotBlank, Assert\All(
        constraints: [
            new Assert\Type(['integer', 'string']),
            new Assert\NotBlank(),
        ]
    )]
    public array $authors;


    #[Assert\NotBlank, Assert\Date(message: "Invalid date format, you need YYYY-mm-dd")]
    #[SerializedPath('[publish_date]')]
    public string $publishDate;
}
