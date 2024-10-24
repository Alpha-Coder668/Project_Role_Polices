<?php
namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
        'price' => $this->faker->randomFloat(2, 10, 1000),
        'description' => $this->faker->sentence(),
        'category_id' => \App\Models\Category::inRandomOrder()->first()->id, // Assuming you have categories
        'images' => json_encode([
            $this->faker->imageUrl(640, 480, 'products', true, 'Faker', true),
            $this->faker->imageUrl(640, 480, 'products', true, 'Faker', true)
        ]),
        'user_id' => User::inRandomOrder()->first()->id, // Get a random user id
        'created_at' => now(),
        'updated_at' => now(),
        ];
    }
}
