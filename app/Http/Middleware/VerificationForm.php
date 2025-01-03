<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class VerificationForm
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        $user = User::select('verified_at')->where('id', session('id'))
            ->first();
        if( !empty( $user->verified_at ) ) {
            return redirect('/');
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
