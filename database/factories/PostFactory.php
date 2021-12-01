<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->slug(),
            'title' => $this->faker->paragraph(),
            'description' => $this->faker->paragraph(),
            'text' => $this->faker->paragraph(5),
            'is_active' => true,
        ];
    }
}
