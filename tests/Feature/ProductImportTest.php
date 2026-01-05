<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class ProductImportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_import_products_from_csv()
    {
        Storage::fake('local');

        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $csvContent = <<<CSV
name,description,price,category,stock
Product A,Desc A,100,Category A,5
Product B,Desc B,200,Category B,10
CSV;

        $file = UploadedFile::fake()->createWithContent(
            'products.csv',
            $csvContent
        );

        $response = $this->actingAs($admin)->post(
    '/admin/products/import',
    ['file' => $file]
);


        $response->assertRedirect();

        $this->assertDatabaseCount('products', 2);
    }
}
