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
                'time_spans_id' => random_int(1, 5),
                'money_estimates_id' => random_int(1, 5),
                'manpowers_id' => random_int(1, 5),
                'material_feasibilities_id' => random_int(1, 5)
            ]);
        }
    }
}
