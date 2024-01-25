<?php

namespace App\Utils\Uploader;

class File
{
    public function __construct(
        public readonly string $path,
        public readonly string $name,
        public readonly int $size,
    ) {
    }

    public function getFilePath():string
    {
        return $this->path . '/' . $this->name;
    }
}