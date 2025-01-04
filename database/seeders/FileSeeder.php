<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/do-an-1.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/do-an-1.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/do-an-2.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/do-an-2.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/do-an-3.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/do-an-3.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/do-an-4.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/do-an-4.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/do-an-5.jpeg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/do-an-5.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/heo-1.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/heo-1.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/heo-2.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/heo-2.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/heo-3.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/heo-3.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
		File::create([
			'url' => 'https://ironhoang-public-images.s3.ap-southeast-1.amazonaws.com/arent/heo-5.jpg',
			'title' => 'do-an',
			'entity_type' => 'image',
			'entity_id' => 0,
			'file_category_type' => 'image',
			's3_key' => 'arent/heo-5.jpg',
			's3_bucket' => 'ironhoang-public-images',
			's3_region' => 'ap-southeast-1',
			's3_extension' => 'image',
			'media_type' => 'jpeg',
			'is_local' => 0,
			'file_size' => 1024,
		]);
	}
}
