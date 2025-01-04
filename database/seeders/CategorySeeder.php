<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$categories = [
			[
				'name' => 'Healthy Nutrition',
				'description' => 'Articles guiding scientific eating habits, balanced nutrition, and health improvement.',
				'file_id' => rand(1, 9),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Physical Training',
				'description' => 'Exercises suitable for everyone to improve endurance and physique.',
				'file_id' => rand(1, 9),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Weight Loss Plans',
				'description' => 'Effective weight loss guides through diet and exercise while avoiding side effects.',
				'file_id' => rand(1, 9),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Mental Well-being',
				'description' => 'Methods to reduce stress, improve sleep, and enhance mental health.',
				'file_id' => rand(1, 9),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'General Health',
				'description' => 'Comprehensive information on maintaining health and preventing diseases.',
				'file_id' => rand(1, 9),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];
		
		DB::table('categories')->insert($categories);
	}
}
