<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderDeleteControllerTest extends BaseOrderControllerTest
{
    use RefreshDatabase;

    public function test_it_delete_order()
    {
        $this->createOrderWithProducts();

        $latestOrder = Order::latest()->first();

        $this->assertNotNull($latestOrder);

        $response = $this->delete('/api/orders/' . $latestOrder->id);

        $response->assertStatus(200);

        $orderAfterDeletion = Order::find($latestOrder->id);
        $this->assertNull($orderAfterDeletion);

    }
}
