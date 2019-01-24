<?php

namespace App\Http\Middleware;

use Closure;
use App\Problem;

class SeeProblem
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
        if ($request->user()->type == 'admin') {
            return $next($request);
        } else {
            $problem = Problem::where('id', $request->route('id'))->get();
            if ($problem->status == 'show') {
                return $next($request);
            }
        }

        abort(403);
    }
}
