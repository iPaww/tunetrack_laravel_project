<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\BasePageController;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderItems;

class AppointmentController extends BasePageController
{
    public string $base_file_path = 'appointment.';

    public function index()
    {
        $appointments = Appointment::where('user_id', session("id"))
            ->with(['orderItems.product', 'orderItems.order', 'assignedUser']) // Ensure this relationship is correct
            ->paginate(9);

        // Fetch orders for the authenticated user
        $orders = Orders::with(['orderItems.product'])
            ->where('user_id', session("id"))
            ->where('status', 3)
            ->get();

        return $this->view_basic_page($this->base_file_path . 'index', compact('appointments', 'orders'));
    }

    public function book()
    {
        // Fetch orders for the authenticated user with order items and products
        $orders = Appointment::where('user_id', session("id")) // Filter by authenticated user
            // ->where('status', 3) // Include orders with status 3
            ->get();

        // Filter out order items with an accepted appointment
        // foreach ($orders as $order) {
        //     $order->orderItems = $order->orderItems->filter(function ($item) {
        //         $appointment = $item->appointment; // Assuming you defined the relationship in OrderItems
        //         return !$appointment || $appointment->status !== 'accepted';
        //     });
        // }

        return $this->view_basic_page($this->base_file_path . 'book', compact('orders'));
    }

    public function store(Request $request)
    {
        // Validation for creating appointment
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:orders_item,product_id',
            'order_id' => 'required|exists:orders_item,order_id',
            'date' => 'required|date',
        ]);
        $product_id = $request->post('product_id');

        $order_id = $request->post('order_id');

        $date = $request->post('date');
        
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }

        // Fetch the order item based on the selected product_id
        $orderItem = OrderItems::where('product_id', $product_id)
        ->where('order_id',$order_id)
        ->first();

        if (empty($orderItem)) {
            return back()->with('error', 'Invalid product selection.');
        }

        // Create the appointment
        Appointment::create([
            'selected_date' => $date,
            'user_id' => session("id"),
            'order_id' => $order_id,
            'status' => 'pending',
            'product_id' => $product_id
        ]);

        return back()->with('success', 'Appointment successfully created!');
    }


    public function edit($id)
    {
        // Fetch the appointment to be updated
        $appointment = Appointment::find($id);

        if (!$appointment || $appointment->user_id !== session("id")) {
            return redirect()->route('appointments.index')->with('error', 'Appointment not found.');
        }

        // Pass the appointment data to the edit view
        return $this->view_basic_page($this->base_file_path . 'edit', compact('appointment'));
    }
    public function update(Request $request, $id)
    {
        // Validate the new date for the reappointment
        $validated = $request->validate([
            'date' => 'required|date',
        ]);

        // Find the appointment
        $appointment = Appointment::find($id);

        // Check if the appointment exists and if the user is the owner
        if (!$appointment || $appointment->user_id !== session("id")) {
            return redirect()->route('appointment.index')->with('error', 'Appointment not found or you do not have permission to update this appointment.');
        }

        // Update the appointment
        $appointment->selected_date = $validated['date'];
        $appointment->status = 'pending'; // Set the status to 'pending' after rebooking

        // Save the updated appointment
        $appointment->save();

        return redirect()->route('appointment.index')->with('success', 'Appointment successfully re-booked!');
    }

    public function rebook($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Assuming the status is 're-book', update the status or change any necessary fields
        $appointment->status = 'pending'; // Reset the status to pending after rebooking
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment successfully re-booked!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        // Check if the appointment exists and belongs to the current user
        if (!$appointment || $appointment->user_id !== session('id')) {
            return redirect()->route('appointment.index')->with('error', 'Appointment not found or you do not have permission to delete this appointment.');
        }

        // Delete the appointment
        $appointment->delete();

        return redirect()->route('appointment.index')->with('success', 'Appointment successfully deleted!');
    }



}
