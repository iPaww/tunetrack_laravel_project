<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\BasePageController;
use App\Models\OrderItems;

class AppointmentController extends BasePageController
{
    public string $base_file_path = 'appointment.';

    public function index()
{
    $appointments = Appointment::where('user_id', session("id"))
        ->with(['orderItems.product', 'orderItems.order']) // Load the order items and related products
        ->get();

    return $this->view_basic_page($this->base_file_path . 'index', compact('appointments'));
}

public function book()
{
    // Pass the appointment data to the edit view
    $orders = Orders::with(['orderItems.product']) // Ensure you load order items and their products
            ->where('user_id', session("id")) // Filter by authenticated user
            ->where('status', 3) // Only include orders with status 3
            ->get();

    return $this->view_basic_page($this->base_file_path . 'book',compact('orders'));
}

    public function store(Request $request)
    {
        // Validation for creating appointment
        $validated = $request->validate([
            'order_id' => 'required|exists:orders_item,product_id',
            'date' => 'required|date',
        ]);

        // Fetch the order item based on the selected product_id
        $orderItem = OrderItems::where('product_id', $validated['order_id'])->first();

        if (!$orderItem) {
            return redirect()->back()->with('error', 'Invalid product selection.');
        }

        // Assuming sub_category_id is part of the product details
        $subCategoryId = $orderItem->product ? $orderItem->product->sub_category_id : null;

        // Create the appointment
        Appointment::create([
            'selected_date' => $validated['date'],
            'user_id' => session("id"),
            'sub_category_id' => $subCategoryId,
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment successfully created!');
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



}
