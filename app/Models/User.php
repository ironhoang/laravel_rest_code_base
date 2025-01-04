<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User.
 *
 * @property int                   $id
 * @property string                $name
 * @property string                $gender
 * @property float                 $height
 * @property float                 $weight
 * @property string                $email
 * @property string                $password
 * @property-read \App\Models\File $profileImage
 * @property \Carbon\Carbon        $created_at
 * @property \Carbon\Carbon        $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereProfileImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends AuthenticatableBase implements JWTSubject
{
	use HasFactory;
	use Notifiable;
	
	const TYPE_GENDER_MALE = 'male';
	const TYPE_GENDER_FEMALE = 'female';
	const TYPE_GENDER_OTHER = 'other';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'gender',
		'weight',
		'height',
		'email',
		'password',
		'profile_image_id',
		'role_id',
	];
	
	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];
	
	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}
	
	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}
	
	public function todayMeals(): HasMany
	{
		return $this->HasMany(DailyMeal::class, 'user_id', 'id')
			->where('date', Carbon::now()->format('Y-m-d'))
			->orderBy('date', 'desc');
	}
	
	public function lastBodyMetric(): HasOne
	{
		return $this->hasOne(BodyMetric::class, 'user_id', 'id')
			->orderBy('date', 'desc')->latestOfMany();
	}
	
	public function todayTargets($date = null): HasMany
	{
		if ($date == null) {
			$date = Carbon::now()->format('Y-m-d');
		}
		return $this->hasMany(DailyExercise::class, 'user_id', 'id')
			->where('date', $date)
			->orderBy('date', 'desc');
	}
	
	public function lastTarget(): HasOne
	{
		return $this->hasOne(DailyExercise::class, 'user_id', 'id')
			->orderBy('date', 'desc')->latestOfMany();
	}
	
	public function dailyMeals(): HasMany
	{
		return $this->hasMany(DailyMeal::class, 'user_id', 'id');
	}
	
	public function bodyMetrics(): HasMany
	{
		return $this->hasMany(BodyMetric::class, 'user_id', 'id');
	}
	
	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class, 'role_id', 'id');
	}
	
	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}
}
