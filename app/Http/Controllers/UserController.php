<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\ApiResponseFormatTrait;
use Illuminate\Foundation\Http\FormRequest;

class UserController extends Controller
{
	use ApiResponseFormatTrait;
	
	protected $userService;
	
	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}
	
	public function getProfile(FormRequest $request)
	{
		$user = auth()->user();
		return new UserResource($user);
	}
	
	public function updateProfile(UpdateProfileRequest $request)
	{
		$updateData = $request->validated();
		
		$user = auth()->user();
		$user = $this->userService->updateUser($user->id, $updateData);
		
		return new UserResource($user);
	}
}
