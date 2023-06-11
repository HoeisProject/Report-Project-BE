<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ReportStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::all()->random()->id,
            'user_id' => User::all()->where('role_id', 2)->random()->id,    // Only Employee can create a report
            'report_statuses_id' => ReportStatus::all()->random()->id,
            'title' => fake()->words(fake()->numberBetween(2, 5), true),
            'description' => fake()->sentences(fake()->numberBetween(2, 5), true),
            'position' => fake()->latitude($min = -90, $max = 90) . '#' . fake()->longitude($min = -180, $max = 180)
        ];
    }
}
