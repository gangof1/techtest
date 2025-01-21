<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::factory()->count(500)->create();
        foreach ($orders as $order) {
            $productsCount = random_int(1, 2);
            $products = Product::inRandomOrder()->take($productsCount)->pluck('id');

            foreach($products as $product){
                Product::findOrFail($product)->decrement('stock', 1);
                $order->products()->attach($product, ['quantity' => 1]);
            }
        }
    }
}
