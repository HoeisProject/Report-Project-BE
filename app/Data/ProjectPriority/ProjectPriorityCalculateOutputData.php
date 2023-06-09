<?php

namespace App\Data\ProjectPriority;

use App\Data\Project\ProjectOutputData;
use App\Models\Project;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;


#[MapName(SnakeCaseMapper::class)]
class ProjectPriorityCalculateOutputData extends Data
{
    public function __construct(
        //
        public float $time_span_weight,

        public float $money_estimate_weight,

        public float $manpower_weight,

        public float $material_feasibility_weight,

        public float $v,

        public Lazy | ProjectOutputData $project,
    ) {
    }

    public static function fromSaw($saw): ProjectPriorityCalculateOutputData
    {

        $project = Project::find($saw->project_id);
        $projectData = Lazy::create(fn () => ProjectOutputData::from($project));

        return new ProjectPriorityCalculateOutputData(
            $saw->time_span,
            $saw->money_estimate,
            $saw->manpower,
            $saw->material_feasibility,
            $saw->v,
            $projectData
        );
    }
}
