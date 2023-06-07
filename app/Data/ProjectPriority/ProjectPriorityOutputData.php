<?php

namespace App\Data\ProjectPriority;

use App\Data\Project\ProjectOutputData;
use App\Data\ReportStatus\ReportStatusData;
use App\Data\User\UserOutputData;
use App\Models\Project;
use App\Models\Report;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;


#[MapName(SnakeCaseMapper::class)]
class ProjectPriorityOutputData extends Data
{
    public function __construct(
        //
        public float $time_spans,

        public float $money_estimates,

        public float $manpowers,

        public float $material_feasibilities,

        public float $v,

        public Lazy | ProjectOutputData $project,
    ) {
    }

    public static function fromSaw($saw): ProjectPriorityOutputData
    {

        $project = Project::find($saw->project_id);
        $projectData = Lazy::create(fn () => ProjectOutputData::from($project));

        return new ProjectPriorityOutputData(
            $saw->time_spans,
            $saw->money_estimates,
            $saw->manpowers,
            $saw->material_feasibilities,
            $saw->v,
            $projectData
        );
    }
}
