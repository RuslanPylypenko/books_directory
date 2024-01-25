<?php

declare(strict_types=1);

namespace App\Book\Api\Update;

use App\Api\InputInterface;
use App\Book\Api\Create\CreateRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\SerializedPath;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateRequest extends CreateRequest
{
}
