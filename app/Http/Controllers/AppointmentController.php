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
    // Fetch orders for the authenticated user with their order items and appointments
    $orders = Orders::with(['orderItems.product', 'orderItems.appointment'])
        ->where('user_id', session("id"))
        ->get();

    // Initialize an array to hold the accepted product IDs
    $acceptedProductIds = [];

    // Loop through the orders to find the accepted items
    foreach ($orders as $order) {
        foreach ($order->orderItems as $orderItem) {
            // If there is an accepted appointment for this order item, add its product_id to the acceptedProductIds array
            if ($orderItem->appointment && $orderItem->appointment->status === 'accepted') {
                $acceptedProductIds[] = $orderItem->product_id;
            }
        }
    }

    // Pass the accepted product IDs to the view
    return $this->view_basic_page($this->base_file_path .'appointment.book', compact('orders', 'acceptedProductIds'));
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


        // Check if there's already an accepted appointment for this order item
        $existingAppointment = Appointment::where('order_id', $order_id)
        ->where('product_id', $product_id)
        ->where('status', 'accepted')
        ->first();

        if ($existingAppointment) {
            return back()->with('error', 'This item is already booked and accepted.');
        }

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

        // return redirect()->route('appointment.index')->with('success', 'Appointment successfully deleted!');
        return back()->with('success', 'Appointment successfully remove!');
    }



}
