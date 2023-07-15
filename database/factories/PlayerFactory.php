<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $first_name = fake()->firstName();
        $last_name = fake()->lastName();
        $slug = Str::slug($first_name.' '.$last_name);

        return [

            'first_name' => $first_name,
            'last_name' => $last_name,
            'slug' => $slug,
            'nickname' => fake()->unique()->word(),
            'birth_date' => fake()->date(),
            'shirt_number' => fake()->unique()->numberBetween(1,99),
            'show_first_name' => fake()->boolean(),
            'show_last_name' => fake()->boolean(),
            'show_nickname' => fake()->boolean(),
            'show_birth_date' => fake()->boolean(),
            'show_shirt_number' => fake()->boolean(),
            'show_photo' => fake()->boolean(),
            'show_about' => fake()->boolean(),
            'show_user' => fake()->boolean(),
            'active' => fake()->boolean(),
        ];
    }
}
