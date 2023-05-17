<?php

namespace App\Data\Role;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;

#[MapName(SnakeCaseMapper::class)]
class RoleData extends Data
{
    public function __construct(
        public ?string $id,
        #[Required(), StringType, Max(255)]
        public string $name,
        #[Required(), StringType, Max(255)]
        public string $description,
    ) {
    }
}
