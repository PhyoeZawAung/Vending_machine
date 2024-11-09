<?php
namespace Tests\Unit;

use App\Http\Controllers\ProductsController;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;

class ProductsControllerUnitTest extends TestCase
{
    use RefreshDatabase;
    public function setUp(): void
    {
        parent::setUp();
        // Refresh the database for each test if using a real database
        // $this->artisan('migrate:fresh');

        $this->artisan('migrate');
    }

    public function test_index_returns_all_products()
    {
        // Product::factory()->count(3)->make(); // Create dummy products

        $controller = new ProductsController();
        $request = Request::create('/products/list', 'GET', [

        ]);
        $response = $controller->index($request);

        $response->assertViewIs('products.list');
        // $this->assertCount(3, $response->original); // Check 3 products are returned
    }
}
