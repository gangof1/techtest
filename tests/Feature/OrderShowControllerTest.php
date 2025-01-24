<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderShowControllerTest extends BaseOrderControllerTest
{
    use RefreshDatabase;

    public function test_it_returns_a_successful_response()
    {
        $this->createOrderWithProducts();

        $latestOrder = Order::latest()->first();

        $response = $this->get('/api/orders/'.$latestOrder->id);
        $responseData = json_decode($response->getContent(), true);
        $response->assertStatus(200);
    }

    public function test_it_returns_products_belonging_to_order()
    {
        $this->createOrderWithProducts();

        $latestOrder = Order::latest()->first();

        $response = $this->get('/api/orders/'.$latestOrder->id);
        $responseData = json_decode($response->getContent(), true);
        $response->assertStatus(200);

        $this->assertArrayHasKey('products', $responseData);
        $this->assertIsArray($responseData['products']);
        $this->assertGreaterThan(0, count($responseData['products']));
    }
}
