<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderFilterRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderFilterRequest $request):JsonResponse
    {
        $items_per_page = config('order_filter.config.items_per_page', 10);
        $fromdate_operator_match = config('order_filter.config.fromdate_operator_match', ">");
        $todate_operator_match = config('order_filter.config.todate_operator_match', ">");

        $fromdate = $request->query('fromdate', false);
        $todate = $request->query('todate', false);
        $name = $request->query('name', '');
        $description = $request->query('description', '');

        $query = Order::with('products')
            ->when($fromdate, function ($query) use ($fromdate, $fromdate_operator_match) {
                return $query->where('date', $fromdate_operator_match, $fromdate);
            })
            ->when($todate, function ($query) use ($todate, $todate_operator_match) {
                return $query->where('date', $todate_operator_match ,  $todate);
            })
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($description, function ($query, $description) {
                return $query->where('description', 'like', '%' . $description . '%');
            })
            ->orderBy('date', 'desc');

        $orders = $query->paginate($items_per_page);

        return response()->json($orders, 200);
    }
}
