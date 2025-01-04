<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseFormatTrait;
use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
	use ApiResponseFormatTrait;
	
	public function handle(Request $request, Closure $next, $role)
	{
		if (!$request->user() || $request->user()->role->slug !== $role) {
			return response()->json(['message' => 'Unauthorized'], 403);
		}
		
		return $next($request);
	}
}
