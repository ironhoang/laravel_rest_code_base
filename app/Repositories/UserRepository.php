<?php

namespace App\Repositories;

use App\Models\Base;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Query\Builder;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
	public function getBlankModel(): Base|Builder
	{
		return new User();
	}
}
