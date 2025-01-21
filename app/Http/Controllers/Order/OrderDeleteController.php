<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderDeleteController extends Controller
{
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

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully'
            ], 200);

        } catch (\Exception $e) {
            logger()->error('Errore durante l\'eliminazione dell\'ordine: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'operation_failed',
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
