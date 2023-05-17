<?php

namespace App\Data\User;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;

#[MapName(SnakeCaseMapper::class)]
class UserLoginData extends Data
{
    public function __construct(

        #[Required(), Email(Email::RfcValidation), Max(255)]
        public string $email,

        #[Required(), Max(25)]
        public string $password,

        // public ?string $ktpImage,
    ) {
    }
}
