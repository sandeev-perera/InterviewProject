<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    "title" => fake()->words(2, true),
    "user_id" => User::factory(),
    "image_path" => "uploads/Images/defaultImage.jpg",
    "category" => fake()->randomElement(["Educational", "Authentic", "General", "History"]),
    "painted_year" => random_int(1980, 2025),
    "description" => fake()->paragraph(5)
];
    }
}
