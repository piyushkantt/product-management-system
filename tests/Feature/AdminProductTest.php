<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_product()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => 199.99,
            'category' => 'Electronics',
            'stock' => 10,
        ]);

        $response->assertRedirect('/admin/products');

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'price' => 199.99,
        ]);
    }
}
