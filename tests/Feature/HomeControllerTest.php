<?php

namespace Tests\Feature;

use App\Models\ProductModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_displayed(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('frontend.home');
    }

    public function test_home_page_displays_products(): void
    {
        // Arrange
        $product = ProductModel::factory()->create([
            'name' => 'Café Especial',
            'categoria' => 'cafes',
            'price' => 15.90,
        ]);

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200);
        $response->assertViewHas('products');
        $response->assertSee('Café Especial');
    }

    public function test_home_page_contains_all_category_buttons(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Cafés');
        $response->assertSee('Salgados');
        $response->assertSee('Combos');
    }
}
