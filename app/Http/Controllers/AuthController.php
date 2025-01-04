<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponseFormatTrait;
use Exception;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
	use ApiResponseFormatTrait;
	
	public function login(LoginRequest $request)
	{
		try {
			$credentials = $request->validated();
			if (!$token = auth()->attempt($credentials)) {
				return $this->unauthorizedResponse();
			}
			return new LoginResource($token);
		} catch (QueryException $queryException) {
			return $this->queryExceptionResponse($queryException);
		} catch (Exception $exception) {
			$this->recordException($exception);
			return $this->serverErrorResponse($exception);
		}
	}
	
	public function storeUser(StoreUserRequest $request)
	{
		try {
			$request->validated();
			$role = Role::where('slug', $request->get('role'))->first();
			$userInput = [
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'password' => $request->get('password'),
				'role_id' => $role->id,
			];
			
			$user = User::create($userInput);
			return (new UserResource($user))->additional($this->preparedResponse('store'));
		} catch (QueryException $queryException) {
			return $this->queryExceptionResponse($queryException);
		}
	}
	
}
