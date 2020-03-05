<?php

namespace App\Http\Middleware;

use App\Position;
use Closure;

class VerifyPositionCount
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
        if (Position::all()->count() === 0) {
            session()->flash('error', 'You need to add Position to be able to create add a leader.');

            return redirect(route('position.index'));
          }

          return $next($request);
    }
}
