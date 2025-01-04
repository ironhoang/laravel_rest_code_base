<?php

namespace App\Services;

use App\Repositories\Contracts\FileRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
	protected $userRepository;
	protected $fileRepository;
	
	public function __construct(
		UserRepositoryInterface $userRepository,
		FileRepositoryInterface $fileRepository,
	)
	{
		$this->userRepository = $userRepository;
		$this->fileRepository = $fileRepository;
	}
	
	public function updateUser(int $userId, $dataInput)
	{
		$user = $this->userRepository->findById($userId);
		if (!$user) {
			return null;
		}
		//to do Update User
		
		return $user;
	}
	
}
