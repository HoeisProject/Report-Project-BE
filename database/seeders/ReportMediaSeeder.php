<?php

namespace Database\Seeders;

use App\Models\ReportMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReportMedia::factory(200)->create();
    }
}
