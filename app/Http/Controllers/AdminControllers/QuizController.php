<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\BasePageController;
use App\Models\Quiz;
use App\Models\Topics;
use Illuminate\Http\Request;

class QuizController extends BasePageController
{
    public string $base_file_path = 'quiz.';

        public function index()
    {
        $quizzes = Quiz::with('course')->paginate(10); // Eager load the course relationship to get course details
        $topics = Topics::all();

        return $this->view_basic_page($this->base_file_path . 'index', compact('quizzes', 'topics'));
    }

    

    public function addQuiz()
    {
        $topic = Topics::all();
        return $this->view_basic_page($this->base_file_path . 'add', compact('topic'));
    }


    // Handle form submission to create a new quiz
    public function add(Request $request)
{
    // Validate the form input
    $validated = $request->validate([
        'course_id' => 'required|exists:courses,id',
        'question' => 'required|string',
        'a_answer' => 'required|string',
        'b_answer' => 'required|string',
        'c_answer' => 'required|string',
        'd_answer' => 'required|string',
        'correct_answer' => 'required|string|in:a,b,c,d', // Correct answer can only be one of these
        'question_order' =>'required|string',
    ]);

    // Check if validation failed
    // if ($validated->fails()) {
    //     dd($validated->errors()); // Dump the validation errors
    // }

    // Convert the correct_answer ('a', 'b', 'c', 'd') to numeric value
    $correctAnswerMap = [
        'a' => 1,
        'b' => 2,
        'c' => 3,
        'd' => 4,
    ];

    // Store the quiz with numeric correct_answer
    Quiz::create([
        'course_id' => $validated['course_id'],
        'question' => $validated['question'],
        'a_answer' => $validated['a_answer'],
        'b_answer' => $validated['b_answer'],
        'c_answer' => $validated['c_answer'],
        'd_answer' => $validated['d_answer'],
        'correct_answer' => $correctAnswerMap[$validated['correct_answer']], // Store as 1, 2, 3, or 4
        'question_order' =>$validated['question_order'],
    ]);

    return redirect()->route('quiz.index')->with('success', 'Quiz added successfully!');
}


// Show the form to edit the quiz
    // Show the form to edit the quiz
        public function edit($id)
    {
        $quiz = Quiz::findOrFail($id); // Find the quiz by ID
        $topics = Topics::all(); // Get all topics for the course select
        
        // Pass both $quiz and $topics to the view
        return $this->view_basic_page($this->base_file_path . 'edit', compact('quiz', 'topics'));
    }





// Update the quiz in the database
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'question' => 'required|string',
            'a_answer' => 'required|string',
            'b_answer' => 'required|string',
            'c_answer' => 'required|string',
            'd_answer' => 'required|string',
            'correct_answer' => 'required|string|in:a,b,c,d',
            'question_order' =>'required|string',
        ]);

        // Convert the correct_answer ('a', 'b', 'c', 'd') to numeric value
        $correctAnswerMap = [
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
        ];

        $quiz = Quiz::findOrFail($id); // Find the quiz by ID
        $quiz->update([
            'course_id' => $validated['course_id'],
            'question' => $validated['question'],
            'a_answer' => $validated['a_answer'],
            'b_answer' => $validated['b_answer'],
            'c_answer' => $validated['c_answer'],
            'd_answer' => $validated['d_answer'],
            'correct_answer' => $correctAnswerMap[$validated['correct_answer']], // Convert correct_answer to numeric value
            'question_order' =>$validated['question_order'],
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
