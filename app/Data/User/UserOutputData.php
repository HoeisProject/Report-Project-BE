<?php

namespace App\Data\User;

use App\Data\Project\ProjectOutputData;
use App\Data\Role\RoleData;
use App\Models\User;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Illuminate\Support\Facades\Storage;

#[MapName(SnakeCaseMapper::class)]
class UserOutputData extends Data
{
    public function __construct(
        public string $id,
        public Lazy | RoleData $role,
        // public DataCollection | Lazy $projects,
        #[DataCollectionOf(ProjectOutputData::class)]
        public Lazy | DataCollection $projects,
        public string $username,
        public string $nickname,
        public string $email,
        public ?string $nik,
        public string $phoneNumber,
        public string $status,
        public string $userImage,
        public ?string $ktpImage,
    ) {
    }

    public static function fromModel(User $user): UserOutputData
    {
        /** @var Lazy|RoleData $projects */
        $role = Lazy::create(fn () => RoleData::from($user->role)); //->defaultIncluded();

        /** @var Lazy|DataCollection $projects */
        $projects = Lazy::create(fn () => ProjectOutputData::collection($user->projects));

        if (str_contains($user->user_image, 'http'))
            $userImage = $user->user_image;
        else
            $userImage = Storage::url($user->user_image);

        if (str_contains($user->ktp_image, 'http'))
            $ktpImage = $user->ktp_image ? $user->ktp_image : null;
        else
            $ktpImage = $user->ktp_image ? Storage::url($user->ktp_image) : null;

        return new UserOutputData(
            $user->id,
            $role,
            $projects,
            $user->username,
            $user->nickname,
            $user->email,
            $user->nik,
            $user->phone_number,
            $user->status,
            $userImage,
            $ktpImage
        );
    }
}
