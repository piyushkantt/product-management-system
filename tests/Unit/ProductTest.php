<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function product_uses_default_image_if_not_provided()
    {
        $product = Product::create([
            'name' => 'Sample Product',
            'price' => 50,
            'category' => 'General',
            'stock' => 5,
        ]);

        $this->assertEquals('default.png', $product->image);
    }
}
