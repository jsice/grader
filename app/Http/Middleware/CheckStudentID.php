<?php

namespace App\Http\Middleware;

use Closure;

class CheckStudentID
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
        if ($request->user()->std_id == null) {
            return redirect('/profile')->withErrors(['กรุณาใส่รหัสนิสิตก่อนจะส่งงานด้วยครับ ขอบคุณครับ']);
        }
        return $next($request);
    }
}
