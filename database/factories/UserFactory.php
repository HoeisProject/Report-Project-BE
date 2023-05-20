<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
            status:
            0 admin
            1 noupload
            2 pending
            3 approve
            4 reject
        */

        (string) $imageDummy = fake()->imageUrl();
        (int) $status = fake()->numberBetween(1, 4);
        (string) $nik = null;
        (string) $ktpImage = null;
        if ($status != 2) {
            $nik = fake()->creditCardNumber(null, false, '-');
            $ktpImage = $imageDummy;
        }
        $username = fake()->userName();
        return [
            // 'role_id' => Role::all()->random()->id,
            'role_id' => 2, // employee
            'username' => $username,
            'nickname' => fake()->name(),
            'email' => $username . '@gmail.com',
            'nik' => $nik,
            'phone_number' => fake()->phoneNumber(),
            'status' => fake()->numberBetween(1, 4),
            'password' => Hash::make($username),
            'user_image' => $imageDummy,
            'ktp_image' => $ktpImage

        ];
        // return [
        //     'name' => fake()->name(),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
