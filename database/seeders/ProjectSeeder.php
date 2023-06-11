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
            'name' => 'Dragonfly Valve Lt. 1 Tower 2',
            'description' => 'Supply keystone brand, Instalasi dragonfly valve',
            'start_date' => fake()->dateTimeBetween('-1 month', '+3 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Pergantian ACB Basemenet Plaza Lt 2',
            'description' => 'Supply ACB, Modifikasi busbar panel',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Renovasi Coffee Shop Pejaten Blok A',
            'description' => 'Design ME, Instalasi penerangan lampu, Instalasi Fire alarm dan springkle, Pengadaan panel penerangan',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Saving energy / inverter system',
            'description' => 'Design saving energy CHWP, Perakitan panel inverter, Instalasi inverter dan energy saving',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        // 4
        Project::create([
            'user_id' => $adminId,
            'name' => 'Renovasi Marketing Office Konoha City',
            'description' => 'Pengadaan york, Instalasi mesin pendingin, Pengadaan system VAC',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Design & built meeting room',
            'description' => 'Design interior, Pekerjaan kelistrikan',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Pemasangan CCTV',
            'description' => 'Supply & instalasi CCTV, Supply alat recording',
            'start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'end_date' => date('Y-m-d', strtotime('+2 month'))
        ]);
        Project::create([
            'user_id' => $adminId,
            'name' => 'Pengadaan dan instalasi humidifier',
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
