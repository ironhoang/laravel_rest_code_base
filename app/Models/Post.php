<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Category.
 *
 * @property int                       $id
 * @property string                    $title
 * @property string                    $content
 * @property int                       $category_id
 * @property int                       $file_id
 * @property-read \App\Models\File     $file
 * @property-read \App\Models\Category $category
 * @property \Carbon\Carbon            $created_at
 * @property \Carbon\Carbon            $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereFileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Base
{
	use HasFactory, Filterable;
	
	protected static array $filterable = [
	];
	protected $table = 'posts';
	protected $perPage = 10;
	protected $fillable = [
		'title',
		'content',
		'category_id',
		'file_id',
	];
	
	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}
	
	public function image(): BelongsTo
	{
		return $this->belongsTo(File::class, 'file_id', 'id');
	}
}
