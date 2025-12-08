<?php

namespace Tests\Feature;

use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create(['role' => 'client']);
    }

    public function test_authenticated_user_can_add_product_to_cart(): void
    {
        // Arrange
        $product = ProductModel::factory()->create([
            'name' => 'Café Expresso',
            'price' => 8.50,
        ]);

        // Act
        $response = $this->actingAs($this->user)
            ->postJson(route('account.cart.add'), [
                'product_id' => $product->id,
                'quantity' => 2,
            ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Produto adicionado ao carrinho!',
            'cartCount' => 2,
        ]);
    }

    public function test_guest_cannot_add_product_to_cart(): void
    {
        // Arrange
        $product = ProductModel::factory()->create();

        // Act
        $response = $this->postJson(route('account.cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // Assert
        $response->assertStatus(401);
    }

    public function test_adding_product_with_invalid_id_fails(): void
    {
        // Act
        $response = $this->actingAs($this->user)
            ->postJson(route('account.cart.add'), [
                'product_id' => 99999,
                'quantity' => 1,
            ]);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('product_id');
    }

    public function test_user_can_update_cart_item_quantity(): void
    {
        // Arrange
        $product = ProductModel::factory()->create(['price' => 10.00]);
        
        $this->actingAs($this->user)
            ->withSession([
                'cart' => [
                    $product->id => [
                        'name' => $product->name,
                        'quantity' => 1,
                        'price' => $product->price,
                        'image' => $product->image,
                    ]
                ]
            ]);

        // Act
        $response = $this->actingAs($this->user)
            ->putJson(route('account.cart.update', $product->id), [
                'quantity' => 5,
            ]);

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Quantidade atualizada!',
        ]);
    }

    public function test_user_can_remove_item_from_cart(): void
    {
        // Arrange
        $product = ProductModel::factory()->create();
        
        // Act
        $response = $this->actingAs($this->user)
            ->withSession([
                'cart' => [
                    $product->id => [
                        'name' => $product->name,
                        'quantity' => 2,
                        'price' => $product->price,
                        'image' => $product->image,
                    ]
                ]
            ])
            ->deleteJson(route('account.cart.destroy', $product->id));

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Produto removido do carrinho!',
            'cartCount' => 0,
        ]);
    }

    public function test_user_can_clear_cart(): void
    {
        // Act
        $response = $this->actingAs($this->user)
            ->deleteJson(route('account.cart.clear'));

        // Assert
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Carrinho limpo!',
            'cartCount' => 0,
            'cartTotal' => 0,
        ]);
    }

    public function test_user_can_view_cart(): void
    {
        // Act
        $response = $this->actingAs($this->user)
            ->get(route('account.cart.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('frontend.cart.review');
        $response->assertViewHas(['cart', 'cartTotal', 'cartSubtotal', 'shipping']);
    }
}
