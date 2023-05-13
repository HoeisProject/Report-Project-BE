<?php

namespace App\Data;

use App\Models\User;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use App\Data\ProjectData;

#[MapName(SnakeCaseMapper::class)]
class UserData extends Data
{
    public function __construct(
        public ?string $id,
        public RoleData $role,
        // public DataCollection | Lazy $projects,
        #[DataCollectionOf(ProjectData::class)]
        public DataCollection $projects,
        public string $username,
        public string $nickname,
        public string $email,
        public ?string $nik,
        public ?string $phoneNumber,
        public string $status,
        public ?string $userImage,
        public ?string $ktpImage,
    ) {
    }

    public static function fromModel(User $user): self
    {

        return new self(
            $user->id,
            RoleData::from($user->role),
            // Lazy::create(fn () => ProjectData::collection($user->projects->toArray())),
            ProjectData::collection($user->projects),
            $user->username,
            $user->nickname,
            $user->email,
            $user->nik,
            $user->phone_number,
            $user->status,
            $user->user_image,
            $user->ktp_image
        );
    }
}
