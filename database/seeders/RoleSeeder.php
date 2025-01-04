<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// Define data for roles table
		$roles = [
			[
				'name' => 'admin',
				'slug' => 'admin',
				'status' => 'active',
				'description' => 'admin role',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'User',
				'slug' => 'user',
				'status' => 'active',
				'description' => 'User Role',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		];
		
		// Insert data into the roles table
		DB::table('roles')->insert($roles);
	}
}
