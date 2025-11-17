<?php

namespace Database\Factories;

use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
{
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoria = $this->faker->randomElement(['cafes','salgados','combos']);
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5, 60),
            'image' => 'images/products/'.$categoria.'-'. $this->faker->numberBetween(1,9) .'.jpg',
            'categoria' => $categoria,
            'badge_tag' => $this->faker->optional(0.4)->randomElement(['NOVO','PROMO','LIMITADO']),
        ];
    }
}
