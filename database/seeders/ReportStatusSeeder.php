<?php

namespace Database\Seeders;

use App\Models\ReportStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReportStatus::create([
            'name' => 'pending',
            'description' => 'Report Pending'
        ]);
        ReportStatus::create([
            'name' => 'approve',
            'description' => 'Report Approve'
        ]);
        ReportStatus::create([
            'name' => 'reject',
            'description' => 'Report Reject'
        ]);
    }
}
