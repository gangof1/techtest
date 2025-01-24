<?php

namespace Tests\Feature;

use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class OrderStoreControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_route_is_valid(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_it_validates_the_input_data()
    {
        $request = [
            'name' => '',
            'products' => []
        ];

        $response = $this->post('/api/orders', $request);

        $response->assertStatus(422);
    }

    public function test_it_returns_an_error_if_stock_is_not_enough()
    {
        $this->seed(ProductSeeder::class);

        $lastProduct = DB::table('products')->orderBy('id', 'desc')->first();

        // Creo la condizione percui il prodotto non è disponibile in quantità necessaria
        DB::statement("UPDATE products SET stock = 1 WHERE id = ".$lastProduct->id);

        $request = [
            'name' => 'Test Order1',
            'description' => 'Test Description',
            'date' => '2025-01-20 12:00:00',
            'products' => [
                ['id' => $lastProduct->id, 'quantity' => 2]
            ]
        ];

        $response = $this->post('/api/orders', $request);

        $response->assertStatus(400);

    }

    public function test_it_returns_an_error_if_products_are_not_unique()
    {
        $this->seed(ProductSeeder::class);

        $lastProduct = DB::table('products')->orderBy('id', 'desc')->first();

        $request = [
            'name' => 'Test Order1',
            'description' => 'Test Description',
            'date' => '2025-01-20 12:00:00',
            'products' => [
                ['id' => $lastProduct->id, 'quantity' => 1],
                ['id' => $lastProduct->id, 'quantity' => 1]
            ]
        ];

        $response = $this->post('/api/orders', $request);

        $response->assertStatus(422);

    }

    public function test_store_success()
    {
        $this->seed(ProductSeeder::class);

        $sampleProducts = DB::table('products')
        ->orderBy('id', 'asc')
        ->limit(3)
        ->get();

        $request = [
            'name' => 'Test Order2',
            'description' => 'Test Description',
            'date' => '2025-01-20 12:00:00',
            'products' => array_map(function ($product) {
                return ['id' => $product->id, 'quantity' => 2];
            }, $sampleProducts->toArray())
        ];

        $response = $this->post('/api/orders', $request);

        $response->assertStatus(201);

    }

}
