<?php

namespace App\Http\Controllers\Order;

use App\ErrorHandlingTrait;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderDeleteController extends Controller
{
    use ErrorHandlingTrait;
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order):JsonResponse
    {
        try {
            DB::transaction(function () use ($order) {

                $order->lockForUpdate();

                // reset stock
                foreach ($order->products as $product) {
                    $product->increment('stock', $product->pivot->quantity);
                }

                $order->products()->detach();

                $order->delete();

            });

            return $this->handleSuccess('Order deleted successfully');

        } catch (\Exception $e) {
            logger()->error('Error while attempting to delete order: ' . $e->getMessage());
            return $this->handleError($e->getMessage(), 400);
        }
    }
}
