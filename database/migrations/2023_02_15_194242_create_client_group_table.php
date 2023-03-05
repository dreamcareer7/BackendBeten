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
	public function up(): void
	{
		Schema::create('client_group', function (Blueprint $table) {
			$table->unsignedBigInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
				->onDelete('cascade');
			$table->unsignedBigInteger('group_id');
			$table->foreign('group_id')->references('id')->on('groups')
				->onDelete('cascade');
			$table->unique(['client_id', 'group_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('client_group');
	}
};
