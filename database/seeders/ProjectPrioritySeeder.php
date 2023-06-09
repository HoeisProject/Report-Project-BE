<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectPriority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $projects = Project::all();
        for ($i = 0; $i < $projects->count(); $i++) {
            ProjectPriority::create([
                'project_id' => $projects[$i]->id,
                'time_span_id' => random_int(1, 5),
                'money_estimate_id' => random_int(1, 5),
                'manpower_id' => random_int(1, 5),
                'material_feasibility_id' => random_int(1, 5)
            ]);
        }
    }
}
