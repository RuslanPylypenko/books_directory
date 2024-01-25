<?php

declare(strict_types=1);

namespace App\Utils\Uploader;

use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    public function __construct(
        private readonly FilesystemOperator $storage,
    ) {
    }

    /**
     * @throws FilesystemException
     */
    public function upload(UploadedFile $file, string $path): File
    {
        $name = Uuid::uuid4()->toString() . '.' . $file->getClientOriginalExtension();

        $this->storage->createDirectory($path);
        $stream = fopen($file->getRealPath(), 'rb+');
        $this->storage->writeStream($path . '/' . $name, $stream);
        fclose($stream);

        return new File($path, $name, $file->getSize());
    }

    public function remove(string $path): void
    {
        $this->storage->delete($path);
    }
}