<?php

namespace Tests\Feature;

use App\Models\Order;
use Database\Seeders\OrderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_delete_order()
    {
        $this->seed();

        $latestOrder = Order::latest()->first();

        $this->assertNotNull($latestOrder);

        $response = $this->delete('/api/orders/' . $latestOrder->id);

        $response->assertStatus(200);

        $orderAfterDeletion = Order::find($latestOrder->id);
        $this->assertNull($orderAfterDeletion);

    }
}
