<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends BasePageController
{
    public string $base_file_path = 'appointment.';

    // Display the list of appointments with optional filtering by status
    public function index(Request $request)
    {
        $status_filter = $request->query('status_filter'); // Get the status_filter query parameter

        $appointments = Appointment::when($status_filter, function ($query) use ($status_filter) {
            return $query->where('status', $status_filter); // Filter appointments by status
        })
        ->with('user') // Eager load user relationship
        ->get();

        return $this->view_basic_page($this->base_file_path . 'index', compact('appointments'));
    }


    // Update the appointment status (Accept, Reject, or Reappoint)
    public function update(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);
    $status = strtolower($request->input('status')); // Ensure lowercase value

    // Only allow valid status options
    $validStatuses = ['pending', 'accepted', 're-book', 'declined'];

    // If the status is valid, update the appointment
    if (in_array($status, $validStatuses)) {
        $appointment->status = $status;
        $appointment->save();
    }

    return redirect()->route('admin.appointment.index')->with('success', 'Appointment status updated.');
}


    


}
