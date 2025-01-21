<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderShowController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order->load('products'), 200);
    }
}
