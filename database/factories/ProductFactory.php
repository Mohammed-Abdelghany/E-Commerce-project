<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;




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
  public function definition(): array
  {
    return [
      'name' => fake()->word,
      'description' => fake()->sentence,
      'price' => fake()->numberBetween(1, 100),
      'quantity' => fake()->numberBetween(1, 100),
      'created_at' => now(),
      'updated_at' => now(),
      'image' => 'public/products/oONSofofzb2xyFRANaVAZqJfdqjb8O8cy4uguZ0k.jpg',
      'status' => 'inactive',
      'user_id' => User::factory(),

    ];
  }
}
