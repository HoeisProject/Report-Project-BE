<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectData extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,

    ) {
    }
}
