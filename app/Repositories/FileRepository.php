<?php

namespace App\Repositories;

use App\Models\Base;
use App\Models\File;
use App\Repositories\Contracts\FileRepositoryInterface;
use Illuminate\Database\Query\Builder;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
	public function getBlankModel(): Base|Builder
	{
		return new File();
	}
}
