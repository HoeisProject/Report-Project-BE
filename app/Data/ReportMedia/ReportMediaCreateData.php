<?php

namespace App\Data\ReportMedia;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Image;

#[MapName(SnakeCaseMapper::class)]
class ReportMediaCreateData extends Data
{
    public function __construct(
        #[Required(), IntegerType]
        public int $report_id,

        #[Required(), Image, Max(1024)] // Max 1024 Kb
        public UploadedFile $attachment,
    ) {
    }
}
