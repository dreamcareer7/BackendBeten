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
		Schema::create('concurrents', function (Blueprint $table) {
			$table->id();
			$table->date('starting_at');
			$table->date('ending_at');
			$table->string('model_type');
			$table->unsignedBigInteger('model_id');
			$table->string('repeated_every');
			$table->text('extra')->nullable();
			$table->timestamp('created_at');
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('concurrents');
	}
};
