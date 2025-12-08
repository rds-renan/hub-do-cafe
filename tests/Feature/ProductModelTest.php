<?php

namespace Tests\Unit;

use App\Models\ProductModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created(): void
    {
        // Arrange & Act
        $product = ProductModel::factory()->create([
            'name' => 'Cappuccino',
            'description' => 'Delicioso cappuccino italiano',
            'price' => 12.50,
            'categoria' => 'cafes',
            'badge_tag' => 'Novo',
        ]);

        // Assert
        $this->assertDatabaseHas('products', [
            'name' => 'Cappuccino',
            'price' => 12.50,
            'categoria' => 'cafes',
        ]);
    }

    public function test_product_has_fillable_attributes(): void
    {
        $product = new ProductModel();

        $expectedFillable = [
            'name',
            'description',
            'price',
            'image',
            'categoria',
            'badge_tag',
        ];

        $this->assertEquals($expectedFillable, $product->getFillable());
    }

    public function test_product_uses_correct_table(): void
    {
        $product = new ProductModel();

        $this->assertEquals('products', $product->getTable());
    }
}
