<?php

namespace App\Http\Controllers\Order;

use App\ErrorHandlingTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderUpdateController extends Controller
{
    use ErrorHandlingTrait;

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderUpdateRequest $request, Order $order):JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $result = DB::transaction(function () use ($validatedData, $order) {
                // reset previous stock availability
                foreach ($order->products as $product) {
                    $product->increment('stock', $product->pivot->quantity);
                }

                // Reset current order products
                $order->products()->detach();

                foreach ($validatedData["products"] as $productData) {

                    // lock to handle concurrency issues
                    $product = Product::where('id', $productData['id'])->lockForUpdate()->first();

                    if ($product->stock < $productData['quantity']) {
                        throw new \Exception("Stock is not enough for product {$product->name}");
                    }

                    $product->decrement('stock', $productData['quantity']);

                    $order->products()->attach($product->id, ['quantity' => $productData['quantity']]);

                    if (!empty($validatedData["name"])){
                        $order->update(['name' => $validatedData["name"]]);
                    }
                    if (request()->has('description')){
                        $order->update(['description' => $validatedData["description"] ]);
                    }
                    if (isset($validatedData['date'])) {
                        $order->update(['date' => $validatedData['date']]);
                    }

                }

                return $order->load('products');
            });

            return response()->json($result, 200);

            //return $this->handleSuccess('Order created successfully', 200');

        } catch (\Exception $e) {
            logger()->error('Order could not be updated: ' . $e->getMessage());
            return $this->handleError('Order could not be updated: ' . $e->getMessage(), 400);
        }
    }
}
