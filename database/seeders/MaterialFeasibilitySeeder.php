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
            'value' => 'Very Bad',
            'weight' => 1
        ]);
        MaterialFeasibility::create([
            'value' => 'Bad',
            'weight' => 2
        ]);
        MaterialFeasibility::create([
            'value' => 'Normal',
            'weight' => 3
        ]);
        MaterialFeasibility::create([
            'value' => 'Good',
            'weight' => 4
        ]);
        MaterialFeasibility::create([
            'value' => 'Very Good',
            'weight' => 5
        ]);
    }
}
