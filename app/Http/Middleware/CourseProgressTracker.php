<?php

namespace App\Http\Middleware;

use Closure;
use \DateTime;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\CourseUserHistory;
use App\Models\TopicsUserHistory;

class CourseProgressTracker
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $user_id = session('id');
        $course_id = request()->route('course_id');
        $topic_id = request()->route('topic_id');

        if( !empty( $user_id ) ) {
            $course_condition = ['user_id' => $user_id, 'course_id' => $course_id];
            if( !empty( $course_id ) && !CourseUserHistory::where($course_condition)->exists() ) {
                CourseUserHistory::create($course_condition, [
                    'user_id' => $user_id,
                    'course_id' => $course_id,
                    'start_date' => new DateTime()
                ] );
            }

            $course_condition = ['user_id' => $user_id, 'topic_id' => $topic_id];
            if( !empty( $topic_id ) && !TopicsUserHistory::where($course_condition)->exists() ) {
                TopicsUserHistory::create($course_condition, [
                    'user_id' => $user_id,
                    'topic_id' => $topic_id,
                    'start_date' => new DateTime()
                ]);
            }
        }
 
        return $response;
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (empty( session('id') ) ) {
            return redirect('login');
        }
    }
}
