<?php

namespace App\Data\Report;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ReportCreateData extends Data
{
    public function __construct(
        #[Required(), IntegerType]
        public int $project_id,

        #[Required(), IntegerType]
        public int $user_id,

        /// New Created Report Always has Pending Status
        // #[Required(), IntegerType]
        // public int $report_status_id,

        #[Required(), StringType, Max(255)]
        public string $title,

        #[Required(), StringType, Max(255)]
        public string $description,

        #[Required(), StringType, Max(255)]
        public string $position,
    ) {
    }
}
