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
        // Get the selected status from the request
        $status = $request->input('status');
        $orderId = $request->input('order_id'); // Fetch Order ID filter

        // Fetch orders with user data, and apply the status filter if provided
        $orders = Orders::with('user')
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status); // Filter by status
            })->when($orderId, function ($query) use ($orderId) {
                return $query->where('id', $orderId);
            })
            
            ->paginate(10)
            ->withQueryString();

        // Map status integer to string value
        $statusMap = [
            1 => 'Pending',
            2 => 'Processing',
            3 => 'Ready to Pickup',
            4 => 'Cancel'
        ];

        // Pass the orders and status map to the view
        return $this->view_basic_page($this->base_file_path . 'index', compact('orders', 'statusMap'));
    }

    public function updateStatus(Request $request)
{
    $validatedData = $request->validate([
        'order_id' => 'required|exists:orders,id',
        'status' => 'required|in:1,2,3,4', // Ensure the status is valid
    ]);

    if ($validatedData['status'] == 4) { // Cancel status
        // Fetch all order items for the given order_id, with related product data
        $orderItems = OrderItems::with('product') // Ensure the `product` relationship works correctly
            ->where('order_id', $validatedData['order_id'])
            ->get();

        foreach ($orderItems as $item) {
            $product = $item->product; // Access related product data

            if ($product) {
                if ($product->product_type_id == 1) {
                    // Update inventory_products: set `taken` to 0, update `serial_number` and `color_id`
                    DB::table('inventory_products')
                        ->where('id', $item->inventory_id)
                        ->update([
                            'taken' => 0,
                            // 'serial_number' => $product_id->serial_number ?? null, // Ensure serial_number is correctly updated
                            // 'color_id' => $product_id->color_id ?? null, // Ensure color_id is correctly updated
                        ]);
            } elseif ($product && $product->product_type_id == 2) {
                // Update inventory_supplies: increase `quantity`
                DB::table('inventory_supplies')
                    ->where('id', $item->inventory_id)
                    ->increment('quantity', $item->quantity);
            }
            }
        }
    }

    // Update the order status
    $order = Orders::findOrFail($validatedData['order_id']);
    $order->status = $validatedData['status'];
    $order->is_read = 0;  
    $order->save();

    return redirect()->route('itemTrack.index')->with('success', 'Order status updated successfully!');
}


}
