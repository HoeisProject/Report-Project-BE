<?php

namespace Database\Seeders;

use App\Models\Manpower;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManpowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manpower::create([
            'min' => 1,
            'max' => 10,
            'weight' => 1,
        ]);
        Manpower::create([
            'min' => 11,
            'max' => 20,
            'weight' => 2,
        ]);
        Manpower::create([
            'min' => 21,
            'max' => 30,
            'weight' => 3,
        ]);
        Manpower::create([
            'min' => 31,
            'max' => 40,
            'weight' => 4,
        ]);
        Manpower::create([
            'min' => 41,
            'max' => 50,
            'weight' => 5,
        ]);
    }
}
