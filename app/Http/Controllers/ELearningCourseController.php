<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

use App\Models\Cart;
use App\Models\CourseHistory;
use App\Models\Courses;
use App\Models\MainCategory;
use App\Models\Quiz;
use App\Models\QuizUserHistory;
use App\Models\Topics;

use App\Http\Controllers\ElearningController;

class ELearningCourseController extends ElearningController
{
    public string $base_file_path = 'elearning.';

    public function view_basic_page( string $page, $params = [], ...$args )
    {
        $categories = [];
        $courses = [];
        $topics = [];
        $quizes = [];

        if( !empty(request()->route('id')) ) {
            $categories = MainCategory::orderBy('name')
                ->get();

            $courses =  Courses::select('id', 'name')
                ->where('category_id', request()->route('id'))
                ->orderBy('name')
                ->orderBy('created_at', 'desc')
                ->get();

            $topics = Topics::select('id', 'title')
                ->where('course_id', request()->route('course_id'))
                ->get();

            if( !empty(request()->route('quiz_id')) ) {
                $quizes = Quiz::select('id', 'question_order')
                    ->where('course_id', request()->route('course_id'))
                    ->orderBy('question_order')
                    ->get();
            }
        }

        $template = 'basic_page';
        if( view()->exists($this->base_file_path . 'template') )
            $template = $this->base_file_path . 'template';

        $cart_count = 0;
        if( !empty(session('id')) ) {
            $cart_count = Cart::where('user_id', session('id'))->count();
        }

        return view( $template, [
            'page_title' => $this->page_title,
            'page' => $page,
            'cart_count' => $cart_count,
            'categories' => $categories,
            'courses' => $courses,
            'topics' => $topics,
            'quizes' => $quizes,
            ...$params
        ], ...$args );
    }

    public function index()
    {
        $category_id = request()->route('id');
        $course_id = request()->route('course_id');
        $course = Courses::where('id', $course_id )
            ->where('category_id', $category_id)
            ->first();

        if( empty( $course ) ) {
            return abort(404);
        }

        return $this->view_basic_page($this->base_file_path . 'course', compact('course'));
    }

    public function topic($category_id, $course_id, $topic_id)
    {
        $course = Courses::where('id', $course_id )
            ->where('category_id', $category_id)
            ->first();

        if( empty( $course ) ) {
            return abort(404);
        }

        $topic = Topics::where('id', $topic_id)
            ->where('course_id', $course_id )
            ->first();

        if( empty( $topic ) ) {
            return abort(404);
        }

        return $this->view_basic_page( $this->base_file_path . 'topic', compact('course', 'topic'));
    }

    public function quiz($category_id, $course_id)
    {
        $course = Courses::where('id', $course_id )
            ->where('category_id', $category_id)
            ->first();

        if( empty( $course ) ) {
            return abort(404);
        }

        $quizes = Quiz::select('id', 'question_order')
            ->where('course_id', $course_id)
            ->orderBy('question_order')
            ->get();

        $answer = Quiz::select('quiz.id')
            ->join('quiz_user_history', 'quiz.id', '=', 'quiz_user_history.quiz_id')
            ->where('course_id', $course_id)
            ->where('user_id', session('id'))
            ->first();

        $started = !empty( $answer );

        return $this->view_basic_page( $this->base_file_path . 'quiz', compact('course', 'quizes', 'started'));
    }

    public function quiz_question($category_id, $course_id, $quiz_id)
    {
        $previousAnswer = 0;
        $course = Courses::where('id', $course_id )
            ->where('category_id', $category_id)
            ->first();

        if( empty( $course ) ) {
            return abort(404);
        }

        $quiz = Quiz::where('id', $quiz_id)
            ->where('course_id', $course_id )
            ->first();

        if( empty( $quiz ) ) {
            return abort(404);
        }

        $prevAnswerRes = QuizUserHistory::select('answer')
            ->where('user_id', session('id'))
            ->where('quiz_id', $quiz_id)
            ->first();

        if( $prevAnswerRes ) {
            $previousAnswer = $prevAnswerRes->answer;
        }

        $finsihed = $this->has_answered_all();

        return $this->view_basic_page( $this->base_file_path . 'quiz_question', compact('course', 'quiz', 'finsihed', 'previousAnswer'));
    }

    public function quiz_submit($category_id, $course_id, $quiz_id, Request $request): RedirectResponse
    {
        // Do not allow modification of exam when finished
        if( $this->has_answered_all() ) {
            return redirect("/elearning/category/$category_id/course/$course_id/quiz/$quiz_id")
                ->withErrors('You are not allowed to answer this question, Please retake the exam in the overall page.');
        }

        $form_answer = $request->post('answer');
        $validator = Validator::make($request->all(), [
            'answer' => 'required',
        ], [
            'answer.required' => 'You must choose an answer from A, B, C, or D!'
        ]);

        if ($validator->fails()) {
            return redirect("/elearning/category/$category_id/course/$course_id/quiz/$quiz_id")
                ->withErrors($validator);
        }

        QuizUserHistory::updateOrCreate(['quiz_id' => $quiz_id, 'user_id' => session('id')], [
            'answer' => $form_answer
        ]);

        $last_questions = Quiz::select('id')->orderBy('question_order', 'desc')->first('id');

        if ( $this->has_answered_all() && $last_questions ) {
            return redirect("/elearning/category/$category_id/course/$course_id/overall");
        }

        $sub_qry = Quiz::raw('SELECT `quiz`.`id` FROM `quiz` JOIN `quiz_user_history` ON `quiz_user_history`.`quiz_id`=`quiz`.`id` WHERE `user_id`=' . session('id') . " AND `course_id`=$course_id");
        $move_to_next_unanswered_question = Quiz::select('id')
            ->whereNotIn('id', [$sub_qry])
            ->orderBy('question_order')
            ->where('course_id', $course_id)
            ->first('id');

        if( !empty( $move_to_next_unanswered_question ) ) {
            return redirect("/elearning/category/$category_id/course/$course_id/quiz/$move_to_next_unanswered_question->id");
        }

        return redirect("/elearning/category/$category_id/course/$course_id/quiz/$quiz_id");
    }

    public function overall( $category_id, $course_id)
    {
        $course = Courses::where('id', $course_id )
            ->where('category_id', $category_id)
            ->first();

        if( empty( $course ) ) {
            return abort(404);
        }

        $finished = $this->has_answered_all();

        $questions = Quiz::where('course_id', $course_id)->count('id');
        $score = Quiz::join('quiz_user_history', 'quiz.correct_answer', '=', 'quiz_user_history.answer')
            ->where(['course_id' => $course_id, 'user_id' => session('id')])
            ->where('quiz.id', QuizUserHistory::raw('`quiz_user_history`.`quiz_id`'))
            ->count('quiz.id');

        $passed = $score >= $questions;

        return $this->view_basic_page( $this->base_file_path . 'overall', compact('course', 'finished', 'score', 'questions', 'passed'));
    }

    public function retake($category_id, $course_id, Request $request): RedirectResponse
    {
        // Do not allow modification of exam when finished
        if( !$this->has_answered_all() ) {
            return redirect("/elearning/category/$category_id/course/$course_id/overall")
                ->withErrors('You have not finished the exam yet');
        }

        if( $this->has_passed() ) {
            return redirect("/elearning/category/$category_id/course/$course_id/overall")
                ->withErrors('You already passed the exam you don\'t have to retake');
        }

        QuizUserHistory::join('quiz', 'quiz_user_history.quiz_id', '=', 'quiz.id')
            ->where(['user_id' => session('id'), 'course_id' => $course_id])
            ->forceDelete();

        return redirect("/elearning/category/$category_id/course/$course_id/quiz");
    }

    private function has_passed() {
        $course_id = request()->route('course_id');
        $questions = Quiz::where('course_id', $course_id)->count('id');
        $score = Quiz::join('quiz_user_history', 'quiz.correct_answer', '=', 'quiz_user_history.answer')
            ->where(['course_id' => $course_id, 'user_id' => session('id')])
            ->where('quiz.id', QuizUserHistory::raw('`quiz_user_history`.`quiz_id`'))
            ->count('quiz.id');

        return $score >= $questions;
    }

    private function has_answered_all() {
        $course_id = request()->route('course_id');
        $questions = Quiz::where('course_id', $course_id)->count('id');
        $answered = QuizUserHistory::join('quiz', 'quiz.id', '=', 'quiz_user_history.quiz_id')
            ->where(['course_id' => $course_id, 'user_id' => session('id')])
            ->count('quiz_user_history.id');

        return $answered >= $questions;
    }
}
