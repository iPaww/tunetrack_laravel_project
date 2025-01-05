<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Courses;
use App\Models\Quiz;

use App\Http\Controllers\BasePageController;

class ProfileController extends BasePageController
{
    public string $base_file_path = 'profile.';

    public function index()
    {
        $profile = User::where('id', session('id'))
            ->first();
        return $this->view_basic_page( $this->base_file_path . 'index', compact( 'profile' ));
    }

    public function learning()
    {
        return $this->view_basic_page( $this->base_file_path . 'learning');
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
                    ->where(['quiz_2.course_id' => Quiz::raw('`quiz`.`course_id`'), 'quiz_user_history_2.user_id' => Quiz::raw('`quiz_user_history`.`user_id`')])
                    ->where('quiz_2.id', Quiz::raw('`quiz_user_history_2`.`quiz_id`'))
            ])
            ->where('user_id', session('id'))
            ->leftJoin('quiz', 'courses.id', '=', 'quiz.course_id')
            ->leftJoin('quiz_user_history', 'quiz.id', '=', 'quiz_user_history.quiz_id')
            ->groupBy('quiz.course_id')
            ->paginate(10);
        return $this->view_basic_page( $this->base_file_path . 'exam', compact('courses'));
    }

    public function certificate()
    {
        return $this->view_basic_page( $this->base_file_path . 'certificate');
    }

    public function orders()
    {
        return $this->view_basic_page( $this->base_file_path . 'orders');
    }
}
