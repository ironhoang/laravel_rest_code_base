<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTable extends Migration
{
	public function up()
	{
		Schema::create('files', function (Blueprint $table) {
			$table->id();
			$table->string('url');
			$table->string('title');
			$table->string('entity_type');
			$table->integer('entity_id');
			$table->boolean('is_local');
			$table->integer('file_category_type');
			$table->string('s3_key');
			$table->string('s3_bucket');
			$table->string('s3_region');
			$table->string('s3_extension');
			$table->string('media_type');
			$table->integer('file_size');
			
			$table->timestamps();
		});
	}
	
	public function down()
	{
		Schema::dropIfExists('files');
	}
}
