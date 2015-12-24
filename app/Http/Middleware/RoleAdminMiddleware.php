<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleAdminMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::check()) {
			if (Auth::user()->role_id != 1) {
				return $next($request);
			} else {
				abort(403, 'アクセス権がありません。');
			}
		} else {
			return redirect()->guest('auth/login');
		}
	}

}
