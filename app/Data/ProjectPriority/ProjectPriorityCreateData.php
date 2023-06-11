<?php

namespace App\Data\ProjectPriority;

use Spatie\LaravelData\Attributes\MapName;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectPriorityCreateData extends Data
{
    public function __construct(
        //
        #[Required(), IntegerType]
        public int $project_id,

        #[Required(), IntegerType]
        public int $time_span_id,

        #[Required(), IntegerType]
        public int $money_estimate_id,

        #[Required(), IntegerType]
        public int $manpower_id,

        #[Required(), IntegerType]
        public int $material_feasibility_id,
    ) {
    }
}
