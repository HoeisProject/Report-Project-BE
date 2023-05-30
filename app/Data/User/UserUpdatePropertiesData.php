<?php

namespace App\Data\User;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Image;

class UserUpdatePropertiesData extends Data
{
    public function __construct(
        #[StringType, Max(255)]
        public ?string $username,

        // #[Email(Email::RfcValidation), Max(255)]
        // public ?string $email,

        #[StringType, Max(255)]
        public ?string $phone_number,

        #[StringType, Max(16)]
        public ?string $nik,

        #[Image, Max(1024)] // Max 1024 Kb
        public ?UploadedFile $ktp_image

    ) {
    }
}
