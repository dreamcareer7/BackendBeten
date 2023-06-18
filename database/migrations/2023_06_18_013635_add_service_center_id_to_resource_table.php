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
		Schema::table('users', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('crews', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('groups', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('clients', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('meals', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('dormitories', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('hospitalities', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('service_commits', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('settings', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('vehicles', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

		Schema::table('personal_access_tokens', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id');
			$table->foreign('service_center_id')->references('id')
				->on('service_centers')
				->onDelete('cascade');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('resources', function (Blueprint $table) {
			//
		});
	}
};
