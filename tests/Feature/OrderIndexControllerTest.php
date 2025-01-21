<?php

namespace Tests\Feature;

use App\Http\Controllers\Order\OrderIndexController;
use App\Http\Requests\OrderFilterRequest;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Database\Seeders\OrderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderIndexControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_successful_response()
    {
        $params =  [
            'fromdate' => '2025-01-01',
            'todate' => '2025-12-31'
        ];
        $url = '/api/orders?' . http_build_query($params);
        $response = $this->get($url);

        $response->assertStatus(200);
    }

    public function test_it_filters_by_date_when_provided()
    {
        $dates = ['2025-01-01', '2025-02-15', '2025-03-30'];
        $orders = collect($dates)->map(function ($date) {
            return Order::factory()->create([
                'date' => $date,
                'description' => 'ordine `filters by date` ' . $date,
            ]);
        });

        $params = [
            'fromdate' => '2025-01-11',
            'todate' => '2025-02-16',
        ];
        $url = '/api/orders?' . http_build_query($params);
        $response = $this->get($url);
        $responseData = json_decode($response->getContent(), true);

        $response->assertStatus(200);
        $this->assertEquals(1, $responseData["total"]);

        $formattedDate = Carbon::parse($responseData["data"][0]["date"])->format('Y-m-d');
        $this->assertEquals($formattedDate, "2025-02-15");

    }

    public function test_it_handles_wrong_date_when_provided()
    {
        $this->seed();

        $params =  [
            'fromdate' => '2025-02-31',
            'todate' => '2025-12-32',
        ];

        $url = '/api/orders?' . http_build_query($params);
        $response = $this->get($url);

        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(422, $response->getStatusCode());

    }


    public function test_index_method_performance()
    {
        $this->seed();

        $startTime = microtime(true);

        $response = $this->get('/api/orders');

        $endTime = microtime(true);

        $execution_time = $endTime - $startTime; // Calcola il tempo di esecuzione

        $response->assertStatus(200);
        $this->assertLessThan(1, $execution_time);
    }
}
