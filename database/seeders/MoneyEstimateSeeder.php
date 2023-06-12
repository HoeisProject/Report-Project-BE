<?php

namespace Database\Seeders;

use App\Models\MoneyEstimate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoneyEstimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 0 - 50.000.000 - 150.000.000 - 400.000.000 - 800.000.000 - 1.000.000.000
        // 0 - 200.000.000 - 400.000.000 - 600.000.000 - 800.000.000 - 1.000.000.000
        MoneyEstimate::create([
            'min' => 0,
            'max' => 200000000 - 1,
            'weight' => 5
        ]);
        MoneyEstimate::create([
            'min' => 200000000,
            'max' => 400000000 - 1,
            'weight' => 4
        ]);
        MoneyEstimate::create([
            'min' => 400000000,
            'max' => 600000000 - 1,
            'weight' => 3
        ]);
        MoneyEstimate::create([
            'min' => 600000000,
            'max' => 800000000 - 1,
            'weight' => 2
        ]);
        MoneyEstimate::create([
            'min' => 800000000,
            'max' => 1000000000000 - 1,
            'weight' => 1
        ]);
    }
}
