<?php

namespace App\Data\ProjectPriority;

use App\Models\Manpower;
use App\Models\MaterialFeasibility;
use App\Models\MoneyEstimate;
use App\Models\Project;
use App\Models\ProjectPriority;
use App\Models\TimeSpan;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectPriorityOutputData extends Data
{
    public function __construct(
        //
        public string $id,

        public string $project_id,

        public TimeSpan $time_span,

        public MoneyEstimate $money_estimate,

        public Manpower $manpower,

        public MaterialFeasibility $material_feasibility,
    ) {
    }

    static public function fromProjectPriority($data): ProjectPriorityOutputData
    {

        $timeSpanData = TimeSpan::find($data->time_span_id)->first(); //->toArray();

        $monesEstimateData = MoneyEstimate::find($data->money_estimate_id); //->first()->toArray();

        $manpowerData = Manpower::find($data->manpower_id)->first(); //->toArray();

        $materialFeasibilityData = MaterialFeasibility::find($data->material_feasibility_id)->first(); //->toArray();

        return new ProjectPriorityOutputData(
            $data->id,
            $data->project_id,
            $timeSpanData,
            $monesEstimateData,
            $manpowerData,
            $materialFeasibilityData,
        );
    }
}
