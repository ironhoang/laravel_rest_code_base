<?php

namespace Database\Seeders;

use App\Models\BodyMetric;
use App\Models\DailyExercise;
use App\Models\DailyMeal;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			CategorySeeder::class,
			PostSeeder::class,
			FileSeeder::class,
			RoleSeeder::class,
		]);
		$user1 = User::create([
			'name' => 'Test User',
			'email' => 'test@example.com',
			'password' => 'Testtest',
			'role_id' => 2,
		]);
		
		$user1 = User::create([
			'name' => 'admin',
			'email' => 'admin@example.com',
			'password' => 'TestAdmin',
			'role_id' => 1,
		]);
	}
	
}
