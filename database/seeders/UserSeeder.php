<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (string) $imageDummy = fake()->imageUrl();
        User::create([
            'role_id' => Role::all()->where('name', 'admin')->first()->id,
            'username' => 'admin',
            'nickname' => 'admin',
            'email' => 'admin@gmail.com',
            // 'nik' => '', // Nullable
            'phone_number' => fake()->phoneNumber(),
            'status' => 0,
            'password' => Hash::make('admin'),
            'user_image' => $imageDummy,
            // 'ktp_image' => $imageDummy
        ]);
        User::create([
            'role_id' => Role::all()->where('name', 'admin')->first()->id,
            'username' => 'developer',
            'nickname' => 'developer',
            'email' => 'developer@gmail.com',
            // 'nik' => '', // Nullable
            'phone_number' => fake()->phoneNumber(),
            'status' => 0,
            'password' => Hash::make('developer'),
            'user_image' => $imageDummy,
            // 'ktp_image' => $imageDummy
        ]);
        User::create([
            'role_id' => Role::all()->where('name', 'employee')->first()->id,
            'username' => 'dio',
            'nickname' => 'dio',
            'email' => 'dio@gmail.com',
            // 'nik' => '', // Nullable
            'phone_number' => fake()->phoneNumber(),
            'status' => 1,
            'password' => Hash::make('dio'),
            'user_image' => 'https://picsum.photos/id/91/300/300',
            // 'ktp_image' => $imageDummy
        ]);

        /*
            status:
            0 admin
            1 noupload
            2 pending
            3 approve
            4 reject
        */
        User::factory(2)->create();
    }
}
