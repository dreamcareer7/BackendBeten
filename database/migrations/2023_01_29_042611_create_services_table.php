<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('services', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->unsignedBigInteger('city');
			$table->datetime('before_date')->nullable();
			$table->datetime('exact_date')->nullable();
			$table->datetime('after_date')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('services');
	}
}
