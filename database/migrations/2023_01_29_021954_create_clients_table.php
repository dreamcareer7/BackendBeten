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
	public function up()
	{
		Schema::create('clients', function (Blueprint $table) {
			$table->id();
			$table->string('fullname')->comment('Arabic language');
			$table->unsignedBigInteger('country_id');
			$table->string('id_type');
			$table->string('id_no');
			$table->boolean('gender')->default('0')->comment('0->male, 1->female');
			$table->boolean('is_handicap')->default(false);
			$table->string('phone')->nullable();
			$table->date('dob')->nullable();

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
		Schema::dropIfExists('clients');
	}
}
