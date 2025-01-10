<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends BasePageController
{
    public string $base_file_path = 'appointment.';

    public function index(Request $request)
{
    $status_filter = $request->query('status_filter');

    $appointments = Appointment::when($status_filter, function ($query) use ($status_filter) {
        return $query->where('status', $status_filter);
    })->with(['user', 'assignedUser', 'orderItems.product', 'orderItems.product.productType'])->paginate(10);

    // Fetch users with role == 2 (teachers)
    $teachers = User::where('role', 2)->get();

    return $this->view_basic_page($this->base_file_path . 'index', compact('appointments', 'teachers'));
}

    public function update(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);

    // Validate and update the status
    $status = strtolower($request->input('status'));
    $validStatuses = ['pending', 'accepted', 're-book', 'declined'];

    if (in_array($status, $validStatuses)) {
        $appointment->status = $status;
    }

    // Handle assigning a teacher (teacher_id)
    $selected_teacher = $request->input('selected_teacher');
    if ($selected_teacher) {
        $appointment->teacher_id = $selected_teacher;  // Assign the teacher to the appointment
    }

    $appointment->save();

    // Redirect back to the previous page instead of the index
    return redirect()->back()->with('success', 'Appointment updated successfully.');
}

    public function salesReport()
    {
        return $this->view_basic_page($this->base_file_path . 'sales-report');
    }
}
