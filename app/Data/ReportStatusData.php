<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ReportStatusData extends Data
{
    public function __construct(
        #[Required(), StringType, Max(255)]
        public string $name,
        #[Required(), StringType, Max(255)]
        public string $description,
    ) {
    }
}
