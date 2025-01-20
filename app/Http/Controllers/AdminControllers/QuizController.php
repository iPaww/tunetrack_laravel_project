<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Quiz;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AdminControllers\BasePageController;

class QuizController extends BasePageController
{
    public string $base_file_path = 'quiz.';

    public function index(Request $request)
    {
        $query = $request->input('query');

        $quizzes = Quiz::with('course')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->whereHas('course', function ($courseQuery) use ($query) {
                    $courseQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($query) . '%']);
                });
            })
            ->paginate(10);

        $courses = Courses::all();
        $correctAnswerMap = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D'];

        return $this->view_basic_page($this->base_file_path . 'index', compact('quizzes', 'courses', 'correctAnswerMap'));
    }

    // Show the form to add a new quiz
    public function addQuiz()
    {
        $courses = Courses::all(); // Fetch all courses
        return $this->view_basic_page($this->base_file_path . 'add', compact('courses'));
    }

    // Handle form submission to create a new quiz
    public function add(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id', // Check against the courses table
            'question' => 'required|string',
            'a_answer' => 'required|string',
            'b_answer' => 'required|string',
            'c_answer' => 'required|string',
            'd_answer' => 'required|string',
            'quiz_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'quiz_audio' => 'nullable|mimes:mp3,wav,ogg|max:10240',
            'correct_answer' => 'required|integer|in:1,2,3,4',  // Store as integer (1, 2, 3, 4)
            'question_order' => 'required|string',
        ]);
        $picturePath = $request->file('quiz_picture') ? $request->file('quiz_picture')->store('quiz/images', 'public') : null;
        $audioPath = $request->file('quiz_audio') ? $request->file('quiz_audio')->store('quiz/audio', 'public') : null;


        Quiz::create([
            'course_id' => $validated['course_id'],
            'question' => $validated['question'],
            'a_answer' => $validated['a_answer'],
            'b_answer' => $validated['b_answer'],
            'c_answer' => $validated['c_answer'],
            'd_answer' => $validated['d_answer'],
            'quiz_picture' => $picturePath,
            'quiz_audio' => $audioPath,
            'correct_answer' => (int)$validated['correct_answer'], // Ensure it’s an integer
            'question_order' => $validated['question_order'],
        ]);

        return redirect()->route('quiz.index')->with('success', 'Quiz added successfully!');
    }

    // Show the form to edit a quiz
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id); // Find the quiz by ID
        $courses = Courses::all(); // Get all courses for the dropdown

        return $this->view_basic_page($this->base_file_path . 'edit', compact('quiz', 'courses'));
    }

    // Handle form submission to update a quiz
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'question' => 'required|string',
            'a_answer' => 'required|string',
            'b_answer' => 'required|string',
            'c_answer' => 'required|string',
            'd_answer' => 'required|string',
            'quiz_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'quiz_audio' => 'nullable|mimes:mp3,wav,ogg|max:10240',
            'correct_answer' => 'required|string|in:a,b,c,d',
            'question_order' => 'required|int',
        ]);

        $correctAnswerMap = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];

        $quiz = Quiz::findOrFail($id);
        
        $imagePath = $quiz->picture; // Fallback to existing picture
        if ($request->hasFile('quiz_picture')) {
            if ($quiz->picture) {
                Storage::disk('public')->delete($quiz->picture);
            }
            $imagePath = $request->file('quiz_picture')->store('quiz/images', 'public');
        }

        // Handle audio upload
        $audioPath = $quiz->audio; // Fallback to existing audio
        if ($request->hasFile('quiz_audio')) {
            if ($quiz->audio) {
                Storage::disk('public')->delete($quiz->audio);
            }
            $audioPath = $request->file('quiz_audio')->store('quiz/audio', 'public');
    }

        $quiz->update([
            'course_id' => $validated['course_id'],
            'question' => $validated['question'],
            'a_answer' => $validated['a_answer'],
            'b_answer' => $validated['b_answer'],
            'c_answer' => $validated['c_answer'],
            'd_answer' => $validated['d_answer'],
            'quiz_picture' => $imagePath,
            'quiz_audio' => $audioPath,
            'correct_answer' => (int)$correctAnswerMap[$validated['correct_answer']],  // Ensure it's an integer
            'question_order' => $validated['question_order'],
        ]);

        return redirect()->route('quiz.index')->with('success', 'Quiz updated successfully!');
    }

    
        public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id); // Find the quiz by ID
        $quiz->delete(); // Delete the quiz

        return redirect()->route('quiz.index')->with('success', 'Quiz deleted successfully!');
    }


}
