<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderStoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request):JsonResponse
    {
        $validatedData = $request->validated();
        try {
            $result = DB::transaction(function () use ($validatedData) {
                $order = Order::create([
                    'name' => $validatedData["name"],
                    'description' => $validatedData["description"],
                    'date' => $validatedData["date"]?? now(),
                ]);

                foreach ($validatedData["products"] as $productData) {

                    // lock to handle concurrency issues
                    $product = Product::lockForUpdate()->findOrFail($productData['id']);

                    // check product in stock availability
                    if ($product->stock < $productData['quantity']) {
                        throw new \Exception("Stock is not enough for product {$product->name}");
                    }

                    $product->decrement('stock', $productData['quantity']);

                    $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);
                }
                return $order->load('products');
            });

            return response()->json($result, 201);
            /*
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully'
            ], 201);
            */

        } catch (\Exception $e) {
            logger()->error('Non è stato possibile procedere alla creazione dell\'ordine: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'operation_failed',
                'message' => $e->getMessage(),
                'status' => 400
            ], 400);
        }
    }
}
