<?php

namespace App\Providers;

use App\Repositories\BodyMetricRepository;
use App\Repositories\Contracts\BodyMetricRepositoryInterface;
use App\Repositories\Contracts\DailyExerciseRepositoryInterface;
use App\Repositories\Contracts\DailyMealRepositoryInterface;
use App\Repositories\Contracts\FileRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\DailyExerciseRepository;
use App\Repositories\DailyMealRepository;
use App\Repositories\FileRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->bind(UserRepositoryInterface::class, UserRepository::class);
		$this->app->bind(FileRepositoryInterface::class, FileRepository::class);
	}
	
	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		//
	}
}
