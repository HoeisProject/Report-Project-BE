<?php

namespace Database\Seeders;

use App\Models\TimeSpan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSpanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TimeSpan::create([
            'min' => 1,
            'max' => 15,
            'weight' => 5
        ]);
        TimeSpan::create([
            'min' => 16,
            'max' => 30,
            'weight' => 4
        ]);
        TimeSpan::create([
            'min' => 31,
            'max' => 45,
            'weight' => 3
        ]);
        TimeSpan::create([
            'min' => 46,
            'max' => 60,
            'weight' => 2
        ]);
        TimeSpan::create([
            'min' => 61,
            'max' => 75,
            'weight' => 1
        ]);
    }
}
