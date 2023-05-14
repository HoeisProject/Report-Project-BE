<?php

namespace App\Data;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectData extends Data
{
    public function __construct(
        public ?string $id,

        public Lazy | int | null $user_id,

        public Lazy | UserData | null $user,

        public string $name,

        public string $description,

        #[
            Date,
            WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM, 'Y-m-d h:i:s']),
            MapInputName('start_date'),
        ]
        public Carbon $start_date,

        #[
            Date,
            WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM, 'Y-m-d h:i:s']),
            MapInputName('end_date'),
            MapOutputName('end_date')
        ]
        public Carbon $end_date,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $deletedAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $createdAt,

        #[WithCast(DateTimeInterfaceCast::class)]
        public ?Carbon $updatedAt,

    ) {
    }

    public static function fromModel(Project $project): ProjectData
    {
        // dd($project);
        // $user = User::find($project->user_id);
        /** @var Lazy|UserData|null $projects */
        $userData = Lazy::create(fn () => UserData::from(User::find($project->user_id)))->defaultIncluded();

        $userId = Lazy::create(fn () => $project->user_id);

        // Kamprettt bener ini solusi :) -> PHP Worst Programming Language
        $deletedAtData = is_null($project->deleted_at) ? null : new Carbon($project->deleted_at);

        return new ProjectData(
            $project->id,
            $userId,
            $userData,
            $project->name,
            $project->description,
            new Carbon($project->start_date),
            new Carbon($project->end_date),
            $deletedAtData,
            new Carbon($project->created_at),
            new Carbon($project->updated_at),
        );
    }
}
