<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('crews', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')
				->onDelete('cascade');
			$table->string('fullname')->comment('Name in Arabic language');
			$table->enum('gender', [
				'Male',
				'Female',
			])->default('Male');
			$table->unsignedBigInteger('profession_id')->nullable();
			$table->foreign('profession_id')->references('id')
				->on('professions')
				->onDelete('cascade');
			$table->unsignedBigInteger('country_id');
			$table->foreign('country_id')->references('id')->on('countries');
			$table->string('phone');
			$table->string('id_type');
			$table->string('id_no');
			$table->date('dob');
			$table->boolean('is_active')->default(true);
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
		Schema::dropIfExists('crews');
	}
};
