<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Orders;
use App\Http\Controllers\AdminControllers\BasePageController;
use Illuminate\Http\Request;
class ItemTrackController extends BasePageController
{
    public string $base_file_path = 'item_track.';

    public function index(Request $request)
    {
        // Get the selected status from the request
        $status = $request->input('status');

        // Fetch orders with user data, and apply the status filter if provided
        $orders = Orders::with('user')
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status); // Filter by status
            })
            ->paginate(10)
            ->withQueryString();

        // Map status integer to string value
        $statusMap = [
            1 => 'Pending',
            2 => 'Processing',
            3 => 'Ready to Pickup',
        ];

        // Pass the orders and status map to the view
        return $this->view_basic_page($this->base_file_path . 'index', compact('orders', 'statusMap'));
    }

    public function updateStatus(Request $request)
{
    $validatedData = $request->validate([
        'order_id' => 'required|exists:orders,id',
        'status' => 'required|in:1,2,3', // Ensure the status is valid
    ]);

    // Find the order and update the status
    $order = Orders::find($validatedData['order_id']);
    $order->status = $validatedData['status'];
    $order->save();

    return redirect()->route('itemTrack.index')->with('success', 'Order status updated successfully!');
}
    

}
