<?php

namespace App\Data\ReportMedia;

use App\Data\Report\ReportOutputData;
use App\Models\Report;
use App\Models\ReportMedia;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ReportMediaOutputData extends Data
{
    public function __construct(
        public string $id,

        public Lazy | ReportOutputData $report,

        public string $attachment,
    ) {
    }

    public static function fromModel(ReportMedia $reportMedia): ReportMediaOutputData
    {
        /** @var Lazy|ReportOutputData|null $projectData */
        $reportData = Lazy::create(fn () => ReportOutputData::from(Report::find($reportMedia->report_id)));

        /// TODO Delete this after production
        $attachment = $reportMedia->attachment;
        if (!str_contains($reportMedia->attachment, 'http')) {
            $attachment = Storage::url($reportMedia->attachment);
        }


        return new ReportMediaOutputData(
            $reportMedia->id,
            $reportData,
            $attachment
        );
    }
}
