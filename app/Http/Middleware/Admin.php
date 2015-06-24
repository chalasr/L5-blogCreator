<?php namespace App\Http\Middleware;

use Closure, Auth, Redirect;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!(Auth::check() && Auth::user()->isAdmin()))
		{
			return Redirect::route('home')->with('fail', 'You should login first and should be admin to access!');
		}
		
		return $next($request);
	}

}
