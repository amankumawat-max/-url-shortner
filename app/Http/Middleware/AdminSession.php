<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Route;
class AdminSession
{
    public function handle(Request $request, Closure $next)
    {
	    if (!$request->session()->exists('CS_ADMIN'))
        {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
