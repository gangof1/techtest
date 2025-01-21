<?php

namespace Tests\Feature;

use App\Models\Order;
use Database\Seeders\OrderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_order_with_valid_data()
    {
        $this->seed();

        $latestOrder = Order::latest()->first();

        $new_quantity = 4;

        $request = [
            'name' => '[upd] Product for testing',
            'description' => '[new] Description',
            'date' =>  now()->format('Y-m-d H:i:s'),
            'products' => [
                ['id' => $latestOrder->products->first()->id, 'quantity' => $new_quantity]
            ]
        ];
        $url = route('orders.update', $latestOrder->id);

        $response = $this->put('/api/orders/'.$latestOrder->id, $request);

        $updatedOrder = Order::find($latestOrder->id);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals($request['description'], $updatedOrder->description);
        $this->assertCount(1, $updatedOrder->products);
        $this->assertEquals($new_quantity, $updatedOrder->products->first()->pivot->quantity);
    }
}
