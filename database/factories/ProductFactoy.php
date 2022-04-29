<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactoyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'Title' => $this->faker->title(),
        'Description' => $this->faker->paragraph(1),
        'Price' => $this->faker->randomFloat($maxDecimals = 2, $min = 1, $max = 100),
        'Stock' => $this->faker->numberBetween(1,10),
        'Status' => $this->faker->randomElement(['available','unavailable']),
        ];
    }
}
