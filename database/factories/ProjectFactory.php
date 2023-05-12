<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 month', '+3 month');
        $endDate = date('Y-m-d', strtotime('+2 month'));
        return [
            'user_id' => User::all()->where('role_id', 1)->random()->id,    // Only admin can create a project
            'name' => fake()->domainName(),
            'description' => fake()->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
    }
}
