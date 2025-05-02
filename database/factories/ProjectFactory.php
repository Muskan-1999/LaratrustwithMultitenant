<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

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
    protected $model = Project::class;
    public function definition(): array
    {

        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 months');
        return [
            'title' => $this->faker->sentence(3), // e.g., "Build CRM App"
    'status' => $this->faker->randomElement(['ongoing', 'cancelled']),
    'total' => $this->faker->randomFloat(2, 1000, 10000),
    'start_date' => $startDate,
    'end_date' => $endDate,
    'open' => $this->faker->boolean,
        ];
    }
}
