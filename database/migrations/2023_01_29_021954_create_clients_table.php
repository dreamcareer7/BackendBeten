<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('clients', function (Blueprint $table) {
			$table->id();
			$table->string('fullname')->comment('Arabic language');
			$table->unsignedBigInteger('country_id');
			$table->string('id_type');
			$table->string('id_number');
			$table->string('id_name');
			$table->enum('gender', [
				'Male',
				'Female',
			])->default('Male');
			$table->boolean('is_handicap')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('clients');
	}
}
