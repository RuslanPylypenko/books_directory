<?php

namespace App\Book;

use App\Utils\Uploader\File;
use App\Utils\Uploader\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    private const IMAGE_DIR = 'books';

    public function __construct(
        private readonly FileUploader $fileUploader,
    ) {
    }

    public function upload(UploadedFile $file): File
    {
        return $this->fileUploader->upload($file, self::IMAGE_DIR);
    }

    public function remove(string $path): void
    {
        $this->fileUploader->remove($path);
    }
}