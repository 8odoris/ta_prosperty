<?php

namespace Database\Factories;

use App\Enums\AgenciesEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spy>
 */
class SpyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'agency' => fake()->randomElement([null, fake()->randomElement(AgenciesEnum::values())]),
            'country_of_operation' => fake()->country(),
            'birth_date' => fake()->dateTimeBetween('-60 years', '-30 years'),
            'death_date' => fake()->randomElement([null, fake()->dateTimeBetween('-10 years', 'now')]),
        ];
    }
}
