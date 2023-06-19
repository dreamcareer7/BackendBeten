<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_centers', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('phone')->nullable();
			$table->string('location')->nullable();
			$table->string('group')->nullable();
			$table->unsignedInteger('maxClientCount')->nullable()->default(0);
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
		Schema::dropIfExists('service_centers');
	}
};
