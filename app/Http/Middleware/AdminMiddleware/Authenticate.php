<?php

namespace App\Http\Middleware\AdminMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $conditions_collection = collect([
            empty( session('admin_user') ),
            session('admin_user.role') >= 3,
        ]);
        $conditions = $conditions_collection->some(function (bool $condition) {
            return $condition;
        });
        
        // Perform action
        if ( $conditions ) {
            return redirect('/login');
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
        if (empty( session('id') ) || session('role') == 'user' ) {
            return redirect('login');
        }
    }
}
