<?php

namespace App\Services;

use App\Repositories\Contracts\FileRepositoryInterface;

class FileService
{
	protected $fileRepository;
	
	public function __construct(
		FileRepositoryInterface $fileRepository,
	)
	{
		$this->fileRepository = $fileRepository;
	}
}