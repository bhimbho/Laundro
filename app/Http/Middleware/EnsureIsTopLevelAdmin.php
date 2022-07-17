<?php

namespace App\Http\Middleware;

use App\Http\Enum\RoleEnum;
use Closure;
use Illuminate\Http\Request;

class EnsureIsTopLevelAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role == RoleEnum::FRONTDESK) {
            return response()->json(['error' => 'You are not authorized to perform this action.'], 403);
        }
        return $next($request);
    }
}
