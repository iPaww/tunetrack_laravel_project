<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class ForceMoveFromLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        if( !empty( session('id') ) ) {
            return redirect('/');
        }

        if( !empty( session('admin_user') ) ) {
            return redirect('/admin');
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
