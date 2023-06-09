<?php

namespace App\Data\Project;

use App\Data\ProjectPriority\ProjectPriorityOutputData;
use App\Data\User\UserOutputData;
use App\Models\Project;
use App\Models\ProjectPriority;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectOutputData extends Data
{
    public function __construct(
        public string $id,

        public Lazy | UserOutputData $user,

        public Lazy | ProjectPriorityOutputData $projectPriority,

        public string $name,

        public string $description,

        #[
            Date,
            DateFormat('Y-m-d h:i:s'),
            WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM, 'Y-m-d h:i:s'])
        ]
        public Carbon $startDate,

        #[
            Date,
            DateFormat('Y-m-d h:i:s'),
            WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM, 'Y-m-d h:i:s'])
        ]
        public Carbon $endDate,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $deletedAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $createdAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public Carbon $updatedAt,

    ) {
    }

    public static function fromModel(Project $project): ProjectOutputData
    {
        // dd($project);
        /** @var Lazy|UserOutputData|null $userData */
        $userData = Lazy::create(fn () => UserOutputData::from(User::find($project->user_id))->include('role'));

        $projectPriority = ProjectPriority::where('project_id', $project->id)->first();
        /** @var Lazy|ProjectPriorityOutputData|null $projectPriorityData */
        $projectPriorityData = Lazy::create(fn () => ProjectPriorityOutputData::from($projectPriority));

        // Kamprettt bener ini solusi :) -> PHP Worst Programming Language
        $deletedAtData = is_null($project->deleted_at) ? null : new Carbon($project->deleted_at);

        return new ProjectOutputData(
            $project->id,
            $userData,
            $projectPriorityData,
            $project->name,
            $project->description,
            new  Carbon($project->start_date),
            new Carbon($project->end_date),
            $deletedAtData,
            new Carbon($project->created_at),
            new Carbon($project->updated_at),
        );
    }
}
