<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIdleTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $lastActivity = session('lastActivity');

            // Check if last activity time is set
            if ($lastActivity && time() - $lastActivity > 7200) { // 1800 seconds = 30 minutes
                // User has been idle for more than 30 minutes, log them out
                Auth::logout();
                session()->forget('lastActivity');
                return redirect()->route('login')->with('message', 'You have been logged out due to inactivity.');
            }
        }

        // Update last activity time
        session(['lastActivity' => time()]);

        return $next($request);
    }
}
