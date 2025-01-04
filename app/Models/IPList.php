<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IPList extends Base
{
	use HasFactory, Filterable;
	
	protected static $filterable = ['ip_address' => 'ip_address', 'status' => 'status', 'ip_type' => 'ip_type'];
	protected $table = 'ip_lists';
	protected $fillable = ['ip_address', 'status', 'ip_type', 'remarks'];
	protected $perPage = 10;
}
