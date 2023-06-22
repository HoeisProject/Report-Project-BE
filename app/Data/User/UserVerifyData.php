<?php

namespace App\Data\User;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Image;

#[MapName(SnakeCaseMapper::class)]
class UserVerifyData extends Data
{
    public function __construct(
        // #[Required(), IntegerType]
        // public int $id,

        #[Required(), StringType, Max(255)]
        public string $nik,

        #[Required(), Image, Max(20000)] // Max 1024 Kb
        public UploadedFile $ktp_image,

    ) {
    }
}
