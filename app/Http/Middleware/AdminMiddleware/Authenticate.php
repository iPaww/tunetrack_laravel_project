<?php

namespace App\Http\Middleware\AdminMiddleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        if (empty( session('id') ) || session('role') == 'user' ) {
            return redirect('admin/login');
        }
 
        // Perform action
 
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
