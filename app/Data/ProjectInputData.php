<?php

namespace App\Data;


use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;

use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ProjectInputData extends Data
{
    public function __construct(
        #[Required(), IntegerType]
        public int $user_id,

        #[Required(), StringType, Max(255)]
        public string $name,

        #[Required(), StringType, Max(255)]
        public string $description,

        #[Date, WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM, 'Y-m-d h:i:s'])]
        public Carbon $start_date,

        #[Date, WithCast(DateTimeInterfaceCast::class, format: [DATE_ATOM, 'Y-m-d h:i:s'])]
        public Carbon $end_date,
    ) {
    }
}
