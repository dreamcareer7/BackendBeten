<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;

class JwtMiddleware
{
	use ResponseTrait;
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		try {
			$user = JWTAuth::parseToken()->authenticate();
		} catch (Exception $e) {
			if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
				return $this->sendError('Token is Invalid', $e->getMessage(), 403);

			}else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
				return $this->sendError('Token is Expired', $e->getMessage(), 403);
			}else{
				return $this->sendError('Authorization Token not found', $e->getMessage(), 403);
			}
		}
		return $next($request);
	}
}
