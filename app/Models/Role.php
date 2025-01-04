<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Base
{
	use HasFactory, Filterable;
	
	const TYPE_ROLE_ADMIN = 'admin';
	const TYPE_ROLE_USER = 'user';
	const TYPE_STATUS = 'active';
	
	public static $isDataFilterAuthorizationEnabled = false;
	public static $isEnableResourceOwnerCheck = false;
	protected static $filterable = ['slug' => 'slug', 'status' => 'status', 'name' => 'name'];
	protected $table = 'roles';
	protected $fillable = ['name', 'slug', 'status', 'description'];
	protected $perPage = 10;
}
