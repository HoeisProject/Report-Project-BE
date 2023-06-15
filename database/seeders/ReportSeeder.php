<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Report::factory(50)->create();
        Report::create([
            'project_id' => 1,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Laporan Supply Water Valve di toko Shihlin',
            'description' => 'Telah menyelesaikan pembawaan supply Water valve ke toko Shihlin',
            'position' => '-6.227480868093258#106.79729148219522'
        ]);
        Report::create([
            'project_id' => 1,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Laporan Instalasi Water Valve di toko Shihlin',
            'description' => 'Melaporkan penyelesaian penginstalasian Water valve di toko Shihlin',
            'position' => '-6.227480868093258#106.79729148219522'
        ]);
        Report::create([
            'project_id' => 2,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Laporan Supply ACB ke Basement Plaza Senayan',
            'description' => 'Telah selesai membawa suplai ACB ke Basement Plaza Senayan',
            'position' => '-6.225266747962383#106.7994246232817'
        ]);
        Report::create([
            'project_id' => 2,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Laporan Task Modifikasi Busbar Panel di Basement Plaza Senayan',
            'description' => 'Menyelesaikan tugas modifikasi busbar panel di Basement Plaza Senayan',
            'position' => '-6.225266747962383#106.7994246232817'
        ]);
        Report::create([
            'project_id' => 3,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Laporan Design ME di Boska Coffee Shop',
            'description' => 'Membuat Design ME(Mekanikal Elektrikal) untuk Boska Coffee Shop',
            'position' => '-6.271298368350136#106.84799360477102'
        ]);
        Report::create([
            'project_id' => 3,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Laporan tugas penginstalasian di Boska Coffee Shop',
            'description' => 'Telah mengerjakan tugas instalasi penerangan lampu, fire alarm dan sprinkler, dan panel penerangan',
            'position' => '-6.271298368350136#106.84799360477102'
        ]);
        Report::create([
            'project_id' => 4,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Perakitan panel inverter di Plaza Semanggi Mall',
            'description' => 'Melakukan Perakitan panel inverter di salah satu outlet di Plaza Semmanggi mall',
            'position' => '-6.21973711620795#106.81446253954806'
        ]);
        Report::create([
            'project_id' => 4,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Menginstalasi Inverter System di Plaza Semanggi',
            'description' => 'Melakukan instalasi inverter system di salah satu outlet di Plaza Semanggi',
            'position' => '-6.21973711620795#106.81446253954806'
        ]);
        Report::create([
            'project_id' => 5,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Pengadaan VAC untuk marketing office',
            'description' => 'Pengadaan VAC untuk marketing office di summarecon mall Bekasi',
            'position' => '-6.22594817057516#107.00114445850463'
        ]);
        Report::create([
            'project_id' => 5,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Melakukan Penginstalasian untuk Renovasi Marketing office',
            'description' => 'Menginstalasi mesin pendingin. dan pengadaan system VAC pada perenovasian marketing office di summarecon mall bekasi',
            'position' => '-6.22594817057516#107.00114445850463'
        ]);
        Report::create([
            'project_id' => 6,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Membuat Design Interior BCA Office',
            'description' => 'Membuat design interior untuk BCA Office jl. Sudirman',
            'position' => '-6.21712391150278#106.81298187811953'
        ]);
        Report::create([
            'project_id' => 6,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Pekerjaan Kelistrikan di BCA Office',
            'description' => 'Memasang dan menyesuaikan kelistrikan sesuai dengan design interior BCA Office yang baru',
            'position' => '-6.21712391150278#106.81298187811953'
        ]);
        Report::create([
            'project_id' => 7,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Mensuplai cctv dan recording tool untuk office di Mall Taman Anggrek',
            'description' => 'Mensuplai cctv dan recording tool untuk pemasangan di salah satu office di mall Taman Anggrek',
            'position' => '-6.178337763909809#106.7922127944456'
        ]);
        Report::create([
            'project_id' => 7,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Penginstalasian cctv di Office Mall Taman Anggrek',
            'description' => 'Menginstalasi sistem cctv dan recording tool di salah satu office di mall Taman Anggrek',
            'position' => '-6.178337763909809#106.7922127944456'
        ]);
        Report::create([
            'project_id' => 8,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Mensuplai Alat Humidifier untuk Chatime Central Park',
            'description' => 'Mensuplai alat humidifier untuk penginstalasian humidifier di toko chatime mall Central Park',
            'position' => '-6.177783104588441#106.79016358685764'
        ]);
        Report::create([
            'project_id' => 8,
            'user_id' => 3,
            'report_statuses_id' => 1,
            'title' => 'Menginstalasi Alat Humidifier untuk Chatime Central Park',
            'description' => 'Menginstalasi alat humidifier di toko chatime mall Central Park',
            'position' => '-6.177783104588441#106.79016358685764'
        ]);
    }
}
