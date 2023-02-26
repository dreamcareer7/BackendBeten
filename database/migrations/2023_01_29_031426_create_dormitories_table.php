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
			$table->string('phones');
			$table->unsignedBigInteger('city_id');
			$table->foreign('city_id')->references('id')->on('cities');
			$table->string('location');
			$table->geometry('coordinate')->nullable()->comment('json of geometry');
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
