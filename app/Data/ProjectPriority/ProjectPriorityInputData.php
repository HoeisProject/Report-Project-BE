<?php

namespace App\Data\ProjectPriority;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectPriorityInputData extends Data
{
    public function __construct(
        #[Required(), IntegerType]
        public int $time_span,

        #[Required(), IntegerType]
        public int $money_estimate,

        #[Required(), IntegerType]
        public int $manpower,

        #[Required(), IntegerType]
        public int $material_feasibility,
    ) {
    }
}
