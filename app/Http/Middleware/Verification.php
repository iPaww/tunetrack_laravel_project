<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class Verification
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        if ( !session('verified') ) {
            return redirect('/verification');
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
