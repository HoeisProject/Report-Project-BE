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
        MoneyEstimate::create([
            'min' => 1000000,
            'max' => 4999999,
            'weight' => 5
        ]);
        MoneyEstimate::create([
            'min' => 5000000,
            'max' => 13999999,
            'weight' => 4
        ]);
        MoneyEstimate::create([
            'min' => 14000000,
            'max' => 20999999,
            'weight' => 3
        ]);
        MoneyEstimate::create([
            'min' => 21000000,
            'max' => 49999999,
            'weight' => 2
        ]);
        MoneyEstimate::create([
            'min' => 50000000,
            'max' => 999999999,
            'weight' => 1
        ]);
    }
}
