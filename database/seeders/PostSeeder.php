<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		for ($i = 1; $i <= 30; $i++) {
			$posts = [
				[
					'title' => '5 Superfoods for a Healthy Diet',
					'content' => 'Learn about the best superfoods to include in your daily meals for a healthier lifestyle.',
					'category_id' => 1,
					'file_id' => rand(1, 9),
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now(),
				],
				[
					'title' => "Beginner's Guide to Yoga",
					'content' => 'Step-by-step instructions for yoga beginners to improve flexibility and reduce stress.',
					'category_id' => 2,
					'file_id' => rand(1, 9),
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now(),
				],
				[
					'title' => 'How to Lose 5kg in a Month Safely',
					'content' => 'A detailed weight loss plan with diet tips and exercise routines to shed weight safely.',
					'category_id' => 3,
					'file_id' => rand(1, 9),
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now(),
				],
				[
					'title' => 'Tips for Better Sleep',
					'content' => 'Practical advice to improve your sleep quality and maintain mental balance.',
					'category_id' => 4,
					'file_id' => rand(1, 9),
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now(),
				],
				[
					'title' => '10 Daily Habits for a Healthier Life',
					'content' => 'Easy habits to integrate into your routine to enhance your overall health and energy.',
					'category_id' => 5,
					'file_id' => rand(1, 9),
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now(),
				],
			
			];
			DB::table('posts')->insert($posts);
		}
		
	}
}
