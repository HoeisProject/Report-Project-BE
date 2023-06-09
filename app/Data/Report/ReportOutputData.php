<?php

namespace App\Data\Report;

use App\Data\Project\ProjectOutputData;
use App\Data\ReportStatus\ReportStatusData;
use App\Data\User\UserOutputData;
use App\Models\Report;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ReportOutputData extends Data
{
    public function __construct(
        public string $id,

        public Lazy | ProjectOutputData $project,

        public Lazy | UserOutputData $user,

        public Lazy | ReportStatusData $reportStatus,

        public string $title,

        public string $description,

        public string $position,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $deletedAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $createdAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updatedAt,
    ) {
    }

    public static function fromModel(Report $report): ReportOutputData
    {

        /** @var Lazy|ProjectOutputData|null $projectData */
        // $projectData = Lazy::create(fn () => ProjectOutputData::from(Project::find($report->project_id)));
        $projectData = Lazy::create(fn () => ProjectOutputData::from($report->project));

        /** @var Lazy|UserOutputData|null $userData */
        // $userData = Lazy::create(fn () => UserOutputData::from(User::find($report->user_id)));
        $userData = Lazy::create(fn () => UserOutputData::from($report->user));

        /** @var Lazy|ReportStatusData|null $reportStatusData */
        // $reportStatusData = Lazy::create(fn () => ReportStatusData::from(ReportStatus::find($report->report_statuses_id)));
        $reportStatusData = Lazy::create(fn () => ReportStatusData::from($report->reportStatus));

        $deletedAtData = is_null($report->deleted_at) ? null : new Carbon($report->deleted_at);

        return new ReportOutputData(
            $report->id,
            $projectData,
            $userData,
            $reportStatusData,
            $report->title,
            $report->description,
            $report->position,
            $deletedAtData,
            new Carbon($report->created_at),
            new Carbon($report->updated_at),
        );
    }
}
