<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Quiz;
use App\Models\Courses;
use Illuminate\Http\Request;
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
            'correct_answer' => 'required|integer|in:1,2,3,4',  // Store as integer (1, 2, 3, 4)
            'question_order' => 'required|string',
        ]);


        Quiz::create([
            'course_id' => $validated['course_id'],
            'question' => $validated['question'],
            'a_answer' => $validated['a_answer'],
            'b_answer' => $validated['b_answer'],
            'c_answer' => $validated['c_answer'],
            'd_answer' => $validated['d_answer'],
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
            'correct_answer' => 'required|string|in:a,b,c,d',
            'question_order' => 'required|int',
        ]);

        $correctAnswerMap = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'course_id' => $validated['course_id'],
            'question' => $validated['question'],
            'a_answer' => $validated['a_answer'],
            'b_answer' => $validated['b_answer'],
            'c_answer' => $validated['c_answer'],
            'd_answer' => $validated['d_answer'],
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
