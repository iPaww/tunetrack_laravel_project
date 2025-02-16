<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Orders;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminControllers\BasePageController;

class ItemTrackController extends BasePageController
{
    public string $base_file_path = 'item_track.';

    public function index(Request $request)
    {
        $status = $request->input('status');
        $orderId = $request->input('order_id');

        $orders = Orders::with('user')
            ->when($status, fn($query) => $query->where('status', $status))
            ->when($orderId, fn($query) => $query->where('id', $orderId))
            ->paginate(10);

        $statusMap = [
            1 => 'Pending',
            2 => 'Processing',
            3 => 'Ready to Pickup',
            4 => 'Cancelled'
        ];

        return $this->view_basic_page($this->base_file_path . 'index', compact('orders', 'statusMap'));
    }

    public function updateStatus(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:1,2,3,4',
        ]);

        $order = Orders::findOrFail($validatedData['order_id']);

        if ($validatedData['status'] == 4) { // If status is Cancelled
            $orderItems = OrderItems::with('product')
                ->where('order_id', $order->id)
                ->get();

            foreach ($orderItems as $item) {
                $product = $item->product;

                if ($product) {
                    if ($product->product_type_id == 1) {
                        // Update inventory_products
                        DB::table('inventory_products')
                            ->where('id', $item->inventory_id)
                            ->update(['taken' => 0]);
                    } elseif ($product->product_type_id == 2) {
                        // Increase inventory_supplies quantity
                        DB::table('inventory_supplies')
                            ->where('id', $item->inventory_id)
                            ->increment('quantity', $item->quantity);
                    }
                }
            }
        }

        $order->status = $validatedData['status'];
        $order->is_read = 0;
        $order->save();

        return redirect()->route('itemTrack.index')->with('success', 'Order status updated successfully!');
    }

    public function applyPwdDiscount(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Orders::findOrFail($validated['order_id']);

        if ($order->has_pwd_discount) {
            return response()->json(['success' => false, 'message' => 'PWD discount has already been applied!']);
        }

        $discountedPrice = round($order->total * 0.90, 2); // 10% discount
        $order->total = $discountedPrice;
        $order->has_pwd_discount = true;
        $order->save();

        return response()->json(['success' => true, 'message' => 'PWD discount applied successfully!']);
    }
}
