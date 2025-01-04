<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('description')->nullable();
			$table->foreignId('file_id')->nullable();
			
			$table->timestamps();
		});
	}
	
	public function down()
	{
		Schema::dropIfExists('categories');
	}
}
