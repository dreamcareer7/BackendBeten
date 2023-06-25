<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('crews', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});

		Schema::table('groups', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});

		Schema::table('clients', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});

		Schema::table('meals', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});
        /*

		Schema::table('dormitories', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});
        */

		Schema::table('hospitalities', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});

		Schema::table('service_commits', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});

		Schema::table('settings', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});

		Schema::table('vehicles', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable()->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('crews', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('groups', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('clients', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('meals', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('dormitories', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('hospitalities', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('service_commits', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('settings', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});

		Schema::table('vehicles', function (Blueprint $table) {
			$table->unsignedBigInteger('service_center_id')->nullable(false)->change();
		});
    }
};
