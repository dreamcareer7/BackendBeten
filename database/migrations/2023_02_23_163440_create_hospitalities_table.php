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
		Schema::create('hospitalities', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('description');
			// TODO: What does required here mean?
			$table->timestamp('required_date');
			$table->unsignedInteger('quantity');
			// TODO: received by user or crew?
			$table->unsignedBigInteger('received_by');
			$table->foreign('received_by')->references('id')->on('crews');
			$table->text('extra')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('hospitalities');
	}
};
