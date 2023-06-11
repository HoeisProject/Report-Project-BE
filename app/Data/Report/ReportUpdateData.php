<?php

namespace App\Data\Report;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ReportUpdateData extends Data
{
    public function __construct(
        #[Required(), StringType, Max(255)]
        public string $title,

        #[Required(), StringType, Max(255)]
        public string $description,

        #[Required(), StringType, Max(255)]
        public string $position,
    ) {
    }
}
