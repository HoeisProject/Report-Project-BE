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
        /*
            status:
            0 admin
            1 noupload
            2 pending
            3 approve
            4 reject
        */
        // 832
        // 836
        // 839
        // 838

        User::create([
            'role_id' => Role::all()->where('name', 'admin')->first()->id,
            'username' => 'admin',
            'nickname' => 'admin',
            'email' => 'admin@gmail.com',
            // 'nik' => '', // Nullable
            'phone_number' => '0000000000',
            'status' => 0,
            'password' => Hash::make('admin'),
            'user_image' => 'https://picsum.photos/id/64/300/300',
            // 'ktp_image' => $imageDummy
        ]);
        User::create([
            'role_id' => Role::all()->where('name', 'admin')->first()->id,
            'username' => 'developer',
            'nickname' => 'developer',
            'email' => 'developer@gmail.com',
            // 'nik' => '', // Nullable
            'phone_number' => '111111111',
            'status' => 0,
            'password' => Hash::make('developer'),
            'user_image' => 'https://picsum.photos/id/822/300/300',
            // 'ktp_image' => $imageDummy
        ]);
        User::create([
            'role_id' => Role::all()->where('name', 'employee')->first()->id,
            'username' => 'rucci',
            'nickname' => 'rucci',
            'email' => 'rucci@gmail.com',
            'nik' => '0123456789321654', // Nullable
            'phone_number' => fake()->phoneNumber(),
            'status' => 3,
            'password' => Hash::make('rucci'),
            // 'user_image' => 'https://picsum.photos/id/342/300/300',
            // 'user_image' => 'https://picsum.photos/id/823/300/300',
            'user_image' => 'user/user-rucci@gmail.com-20230613.jpg',
            'ktp_image' => 'ktp/ktp-rucci@gmail.com.png'
        ]);
        User::create([
            'role_id' => Role::all()->where('name', 'employee')->first()->id,
            'username' => 'kanan',
            'nickname' => 'kanan',
            'email' => 'kanan@gmail.com',
            // 'nik' => '', // Nullable
            'phone_number' => fake()->phoneNumber(),
            'status' => 1,
            'password' => Hash::make('kanan'),
            'user_image' => 'https://picsum.photos/id/453/300/300',
            // 'ktp_image' => $imageDummy
        ]);
        User::create([
            'role_id' => Role::all()->where('name', 'employee')->first()->id,
            'username' => 'kiri',
            'nickname' => 'kiri',
            'email' => 'kiri@gmail.com',
            // 'nik' => '', // Nullable
            'phone_number' => fake()->phoneNumber(),
            'status' => 1,
            'password' => Hash::make('kiri'),
            'user_image' => 'https://picsum.photos/id/804/300/300',
            // 'ktp_image' => $imageDummy
        ]);
    }
}
