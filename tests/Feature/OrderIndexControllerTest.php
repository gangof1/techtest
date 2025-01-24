<?php

namespace Tests\Feature;


use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderIndexControllerTest extends BaseOrderControllerTest
{
    //use RefreshDatabase;

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



    public function test_it_handles_wrong_date_when_provided()
    {
        $this->createOrderWithProducts();

        $params =  [
            'fromdate' => '2025-02-31',
            'todate' => '2025-12-32',
        ];

        $url = '/api/orders?' . http_build_query($params);
        $response = $this->get($url);

        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(422, $response->getStatusCode());

    }

}
