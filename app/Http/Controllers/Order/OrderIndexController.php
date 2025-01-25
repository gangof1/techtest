<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderFilterRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Meilisearch\Endpoints\Indexes;
use Meilisearch\Meilisearch;

use function Psy\debug;

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

        // Scout + MeiliSearch
        $filters = [];
        if ($fromdate) {
            $fromdateTimestamp = Carbon::parse($fromdate)->startOfDay()->timestamp;
            $filters[] = "date_timestamp {$fromdate_operator_match} {$fromdateTimestamp}";
        }
        if ($todate) {
            $todateTimestamp = Carbon::parse($todate)->endOfDay()->timestamp;
            $filters[] = "date_timestamp {$todate_operator_match} {$todateTimestamp}";
        }


        $orders = Order::search($name.' '.$description,
            function (Indexes $meilisearch, $query, $options) use ($filters) {
                if (!empty($filters)){
                    $filterString = implode(' AND ', $filters);
                    $options['filter'] = $filterString;
                }
                return $meilisearch->search($query, $options);
                //return $meilisearch->rawSearch($query, $options);
            })
            ->orderBy('date_timestamp', 'desc')
            ->paginate($items_per_page)->withQueryString();

/*
        // Eloquent
        $query = Order::with('products')
            ->when($fromdate, function ($query) use ($fromdate, $fromdate_operator_match) {
                return $query->where('date', $fromdate_operator_match, Carbon::parse($fromdate)->startOfDay()->format('Y-m-d H:i:s'));
            })
            ->when($todate, function ($query) use ($todate, $todate_operator_match) {
                return $query->where('date', $todate_operator_match ,  Carbon::parse($todate)->endOfDay()->format('Y-m-d H:i:s'));
            })
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($description, function ($query, $description) {
                return $query->where('description', 'like', '%' . $description . '%');
            })
            ->orderBy('date', 'desc');
        $orders = $query->paginate($items_per_page)->withQueryString();
*/
        return response()->json($orders, 200);
    }
}
