<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderUpdateControllerTest extends BaseOrderControllerTest
{
    use RefreshDatabase;

    public function test_it_updates_order_with_valid_data()
    {
        $this->createOrderWithProducts();
        $latestOrder = Order::latest()->first();

        $new_quantity = 4;

        $request = [
            'name' => '[upd] Product for testing - '.uniqid("tst_"),
            'description' => '[new] Description',
            'date' =>  now()->format('Y-m-d H:i:s'),
            'products' => [
                ['id' => $latestOrder->products->first()->id, 'quantity' => $new_quantity]
            ]
        ];
        $url = route('orders.update', $latestOrder->id);

        $response = $this->patch('/api/orders/'.$latestOrder->id, $request);

        $updatedOrder = Order::find($latestOrder->id);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals($request['description'], $updatedOrder->description);
        $this->assertCount(1, $updatedOrder->products);
        $this->assertEquals($new_quantity, $updatedOrder->products->first()->pivot->quantity);
    }

    public function test_it_returns_an_error_if_products_are_not_defined()
    {
        $this->createOrderWithProducts();
        $latestOrder = Order::latest()->first();

        $new_quantity = 4;

        $request = [
            'name' => '[upd] Product for testing - '.uniqid("tst_"),
            'description' => '[new] Description',
            'date' =>  now()->format('Y-m-d H:i:s'),
        ];
        $url = route('orders.update', $latestOrder->id);

        $response = $this->patch('/api/orders/'.$latestOrder->id, $request);

        $updatedOrder = Order::find($latestOrder->id);

        $this->assertEquals(422, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('products', $responseData['errors']);
    }

    public function test_it_returns_an_error_if_product_have_quantity_set_to_zero()
    {
        $this->createOrderWithProducts();
        $latestOrder = Order::latest()->first();

        $new_quantity = 0;

        $request = [
            'name' => '[upd] Product for testing - '.uniqid("tst_"),
            'description' => '[new] Description',
            'date' =>  now()->format('Y-m-d H:i:s'),
            'products' => [
                ['id' => $latestOrder->products->first()->id, 'quantity' => $new_quantity]
            ]
        ];
        $url = route('orders.update', $latestOrder->id);

        $response = $this->patch('/api/orders/'.$latestOrder->id, $request);
        $this->assertEquals(422, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('errors', $responseData);
        $this->assertArrayHasKey('products.0.quantity', $responseData['errors']);
    }
}
