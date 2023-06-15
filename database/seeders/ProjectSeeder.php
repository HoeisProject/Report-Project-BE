<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TOTAL 12
        // Project::factory(5)->create();
        $adminId = User::all()->where('role_id', 1)->random()->id;
        Project::create([
            'user_id' => $adminId,
            'name' => 'Water Valve toko Shihlin',
            'description' => 'Supply Water Valve, Instalasi Water valve',
            'start_date' => fake()->dateTimeBetween('-1 month', '+3 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Pergantian ACB Basement Plaza Lt 2',
            'description' => 'Supply ACB, Modifikasi busbar panel',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Renovasi Boska Coffee Shop',
            'description' => 'Design ME, Instalasi penerangan lampu, Instalasi Fire alarm dan sprinkler, Pengadaan panel penerangan',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'instalasi inverter system di Plaza Semanggi',
            'description' => 'Perakitan panel inverter, Instalasi inverter dan energy saving',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        // 4
        Project::create([
            'user_id' => $adminId,
            'name' => 'Renovasi Marketing Office di Summarecon Mall Bekasi',
            'description' => 'Pengadaan system VAC, Instalasi mesin pendingin',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Design & built meeting room di BCA office',
            'description' => 'Design interior, Pekerjaan kelistrikan',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Pemasangan CCTV di Taman Anggrek',
            'description' => 'Supply & instalasi CCTV, Supply alat recording',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Pengadaan dan instalasi humidifier di Chatime Mall Central Park ',
            'description' => 'Supply & instalasi humidifier',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        // 8
        Project::create([
            'user_id' => $adminId,
            'name' => 'Pengadaan AVR',
            'description' => 'Supply AVR 1250kva & 3000kva',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Panel listrik',
            'description' => 'Instalasi panel listrik',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Dehumidifier',
            'description' => 'Instalasi dehumidifier',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Fire Fighting',
            'description' => 'Fire fighting (water springkle dan CO2 powder)',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        // 12
    }
}
