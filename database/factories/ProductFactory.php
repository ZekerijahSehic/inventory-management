<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(12),
            'price' => $this->faker->numberBetween(1, 3000),
            'description' => $this->faker->sentence(200),
            'category_id' => $this->faker->numberBetween(1,3)
        ];
    }
}
