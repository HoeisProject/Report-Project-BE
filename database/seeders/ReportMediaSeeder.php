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
        ReportMedia::create([
            'report_id' => '1',
            'attachment' => 'attachment/report_1_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '1',
            'attachment' => 'attachment/report_1_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '2',
            'attachment' => 'attachment/report_2_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '2',
            'attachment' => 'attachment/report_2_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '3',
            'attachment' => 'attachment/report_3_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '3',
            'attachment' => 'attachment/report_3_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '4',
            'attachment' => 'attachment/report_4_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '5',
            'attachment' => 'attachment/report_5_media_1.png'
        ]);
        ReportMedia::create([
            'report_id' => '6',
            'attachment' => 'attachment/report_6_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '7',
            'attachment' => 'attachment/report_7_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '8',
            'attachment' => 'attachment/report_8_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '8',
            'attachment' => 'attachment/report_8_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '9',
            'attachment' => 'attachment/report_9_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '9',
            'attachment' => 'attachment/report_9_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '10',
            'attachment' => 'attachment/report_10_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '11',
            'attachment' => 'attachment/report_11_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '11',
            'attachment' => 'attachment/report_11_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '12',
            'attachment' => 'attachment/report_12_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '12',
            'attachment' => 'attachment/report_12_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '13',
            'attachment' => 'attachment/report_13_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '13',
            'attachment' => 'attachment/report_13_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '14',
            'attachment' => 'attachment/report_14_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '14',
            'attachment' => 'attachment/report_14_media_2.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '15',
            'attachment' => 'attachment/report_15_media_1.jpg'
        ]);
        ReportMedia::create([
            'report_id' => '16',
            'attachment' => 'attachment/report_16_media_1.jpg'
        ]);
    }
}
