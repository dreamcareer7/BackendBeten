<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceCommitsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('service_commits', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('service_id');
			$table->foreign('service_id')->references('id')->on('services');
			$table->string('badge');
			$table->datetime('schedule_at');
			$table->datetime('started_at')->nullable();
			$table->string('from_location');
			$table->unsignedBigInteger('supervisor_id')->comment('user_id');
			// TODO: this column is set as DATETIME on the diagram
			// Check authenticity
			$table->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('service__commits');
	}
}
