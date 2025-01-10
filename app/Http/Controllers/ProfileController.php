<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Orders;

use App\Models\Courses;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\CourseUserHistory;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BasePageController;

class ProfileController extends BasePageController
{
    public string $base_file_path = 'profile.';

    public function index()
    {
        $profile = User::where('id', session('id'))
            ->first();
        return $this->view_basic_page($this->base_file_path . 'index', compact('profile'));
    }

    public function learning()
    {
        $courses_history = CourseUserHistory::select('courses_user_history.*',
                Courses::raw('COUNT(topics_user_history.id) as topics_viewed')
            )
            ->where('courses_user_history.user_id', session('id'))
            ->leftJoin('topics', 'courses_user_history.course_id', '=', 'topics.course_id')
            ->leftJoin('topics_user_history', 'topics.id', '=', 'topics_user_history.topic_id')
            ->groupBy('courses_user_history.course_id')
            ->paginate(10);

        return $this->view_basic_page($this->base_file_path . 'learning', compact('courses_history'));
    }

    public function exam()
    {
        $courses = Courses::select('courses.*',
                Courses::raw('COUNT(quiz.course_id) as answered')
            )
            ->addSelect([
                'correct_answers' => DB::table('quiz as quiz_2')
                    ->select(DB::raw('COUNT(*)'))
                    ->join(DB::raw('quiz_user_history as quiz_user_history_2'), 'quiz_2.correct_answer', '=', 'quiz_user_history_2.answer')
                    ->where(['quiz_2.course_id' => Quiz::raw('quiz.`course_id`'), 'quiz_user_history_2.user_id' => Quiz::raw('quiz_user_history.`user_id`')])
                    ->where('quiz_2.id', Quiz::raw('quiz_user_history_2.`quiz_id`'))
            ])
            ->where('user_id', session('id'))
            ->leftJoin('quiz', 'courses.id', '=', 'quiz.course_id')
            ->leftJoin('quiz_user_history', 'quiz.id', '=', 'quiz_user_history.quiz_id')
            ->groupBy('quiz.course_id')
            ->paginate(10);
        return $this->view_basic_page($this->base_file_path . 'exam', compact('courses'));
    }

    public function showBook()
    {
        $appointments = Appointment::where('user_id', session("id"))
        ->with(['orderItems.product', 'orderItems.order']) // Load the order items and related products
        ->paginate(9);

    // Fetch orders for the authenticated user
    $orders = Orders::with(['orderItems.product'])
        ->where('user_id', session("id"))
        ->where('status', 3)
        ->get();

    return $this->view_basic_page($this->base_file_path . 'appointment', compact('appointments', 'orders'));
    }

        return $this->view_basic_page($this->base_file_path . 'appointment', compact('appointments', 'orders', 'appointment'));
    }

    public function orders()
    {
        return $this->view_basic_page($this->base_file_path . 'orders');
    }

    // New methods for profile update
    public function edit()
    {
        // Fetch user's profile data for editing
        $profile = User::where('id', session('id'))->first();
        return $this->view_basic_page($this->base_file_path . 'edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profile = User::find(session('id'));

        if (!$profile) {
            return redirect()->back()->with('error', 'User not found!');
        }

        $profile->fullname = $validated['fullname'];
        $profile->phone_number = $validated['phone_number'];
        $profile->address = $validated['address'];

        if ($request->hasFile('image')) {
            if ($profile->image && file_exists(storage_path('app/public/' . $profile->image))) {
                unlink(storage_path('app/public/' . $profile->image));
            }

            $imagePath = $request->file('image')->store('userprofile/' . $profile->id, 'public');
            $profile->image = 'storage/' . $imagePath;
            session([ 'profile_picture' => 'storage/' . $imagePath ]);
        }

        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function rebook($id)
    {
        $appointment = Appointment::findOrFail($id);

        // Assuming the status is 're-book', update the status or change any necessary fields
        $appointment->status = 'pending'; // Reset the status to pending after rebooking
        $appointment->save();

        return redirect()->route('profile.appointment')->with('success', 'Appointment successfully re-booked!');
    }

    public function updateAppointment(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date|after:today',
        ]);

        $appointment = Appointment::where('id', $id)
            ->where('user_id', session('id'))
            ->first();

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found!');
        }

        $appointment->selected_date = $validated['date'];
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment updated successfully!');
    }

    public function editAppointment($id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('user_id', session('id'))
            ->first();

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found!');
        }

        return view('profile.edit', compact('appointment'));
    }
}
