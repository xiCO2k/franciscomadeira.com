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
            'share_img' => $this->faker->imageUrl(1200, 628),
            'is_active' => true,
            'is_hidden' => false,
        ];
    }
}
