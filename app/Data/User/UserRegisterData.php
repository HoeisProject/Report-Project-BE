<?php

namespace App\Data\User;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\In;

#[MapName(SnakeCaseMapper::class)]
class UserRegisterData extends Data
{
    public function __construct(
        // #[Required(), IntegerType]
        // public int $role_id,

        #[Required(), StringType, Max(255)]
        public string $username,

        #[Required(), StringType, Max(255)]
        public string $nickname,

        #[Required(), Email(Email::RfcValidation), Max(255)]
        public string $email,

        // #[Required(), StringType, Max(255)]
        // public ?string $nik,

        #[Required(), StringType, Max(255)]
        public string $phone_number,

        #[Required(), IntegerType, In(1)]  // 1 = noupload - need to verify
        public string $status,

        #[Required(), Max(25)]
        public string $password,

        #[Required(), Image, Max(20000)] // Max 1024 Kb
        public UploadedFile $user_image,

        // public ?string $ktpImage,
    ) {
    }
}
