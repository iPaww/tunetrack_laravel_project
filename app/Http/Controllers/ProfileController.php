<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Courses;
use App\Models\Quiz;
use App\Models\CourseUserHistory;

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

    public function certificate()
    {
        return $this->view_basic_page($this->base_file_path . 'certificate');
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
        $user = User::find(session('id'));

        // Validate the request
        $request->validate([
            'fullname' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update profile picture if provided
        if ($request->hasFile('profile_picture')) {
            $profileImage = $request->file('profile_picture');
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();

            // Store the image in public/user/{user_id}
            $path = 'public/user/' . session('id');
            $profileImage->storeAs($path, $imageName);  // Store the image in the correct folder

            // $imageName = time() . '.' . $request->image->extension();
            // $image = $request->file('image');
            // $imagePath = $image->storeAs("adminprofile/$user->id",$imageName, 'public');
            // $user->image = 'storage/' . $imagePath;
            // session([ 'admin_user.profile_picture' => 'storage/' . $imagePath ]);

            // Update the image field in the user table
            $user->image = $imageName;
        }

        // Update user details
        $user->fullname = $request->fullname;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully!',
            'profile' => $user,
        ]);
    }
}
