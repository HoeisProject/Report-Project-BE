<?php

namespace Database\Seeders;

use App\Models\MaterialFeasibility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialFeasibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialFeasibility::create([
            'description' => 'Very Bad',
            'weight' => 1
        ]);
        MaterialFeasibility::create([
            'description' => 'Bad',
            'weight' => 2
        ]);
        MaterialFeasibility::create([
            'description' => 'Normal',
            'weight' => 3
        ]);
        MaterialFeasibility::create([
            'description' => 'Good',
            'weight' => 4
        ]);
        MaterialFeasibility::create([
            'description' => 'Very Good',
            'weight' => 5
        ]);
    }
}
