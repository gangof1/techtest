<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BaseOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function createOrderWithProducts (int $quantity = 1)
    {
        $this->seed(ProductSeeder::class);
        $orders = Order::factory()->count($quantity)->create();
        foreach ($orders as $order) {
            $productsCount = random_int(1, 2);
            $products = Product::inRandomOrder()->take($productsCount)->pluck('id');

            foreach($products as $product){
                Product::findOrFail($product)->decrement('stock', 1);
                $order->products()->attach($product, ['quantity' => 1]);
            }
        }
        return $orders;
    }
}
