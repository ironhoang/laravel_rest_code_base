<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Category.
 *
 * @property int                   $id
 * @property string                $name
 * @property string                $description
 * @property int                   $file_id
 * @property-read \App\Models\File $file
 * @property \Carbon\Carbon        $created_at
 * @property \Carbon\Carbon        $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Base
{
	use HasFactory, Filterable;
	
	protected static array $filterable = [
	];
	protected $table = 'categories';
	protected $perPage = 10;
	protected $fillable = [
		'name',
		'description',
		'file_id',
	];
	
	public function image(): BelongsTo
	{
		return $this->belongsTo(File::class, 'file_id', 'id');
	}
}
