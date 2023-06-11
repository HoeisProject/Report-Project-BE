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

        $a = [1, 4, 2, 3, 4, 2, 3, 1, 5, 4, 1, 2]; // Time Span
        $b = [4, 2, 3, 2, 1, 2, 4, 5, 2, 5, 4, 3]; // Money Estimate
        $c = [3, 4, 1, 5, 1, 2, 5, 3, 4, 2, 2, 3]; // Manpower
        $d = [4, 5, 3, 4, 2, 5, 2, 4, 1, 5, 3, 4]; // Material Feasibility

        for ($i = 0; $i < $projects->count(); $i++) {
            ProjectPriority::create([
                'project_id' => $projects[$i]->id,
                'time_span_id' => $a[$i],
                'money_estimate_id' => $b[$i],
                'manpower_id' => $c[$i],
                'material_feasibility_id' => $d[$i]
            ]);
        }
        // ProjectPriority::create([
        //     'project_id' => $projects[$i]->id,
        //     'time_span_id' => random_int(1, 5),
        //     'money_estimate_id' => random_int(1, 5),
        //     'manpower_id' => random_int(1, 5),
        //     'material_feasibility_id' => random_int(1, 5)
        // ]);
    }
}
