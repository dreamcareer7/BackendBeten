<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDormitoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dormitories', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('phone');
			$table->string('country');
			$table->string('city_id');
			$table->string('location');
			$table->string('coordinate')->nullable()->comment('json of geometry');
			$table->boolean('is_active')->default(true);

			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('dormitories');
	}
}
