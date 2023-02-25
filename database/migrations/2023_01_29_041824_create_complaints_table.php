<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('complaints', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('referfence')->nullable();
			$table->string('commenter_model_type')->nullable();
			$table->unsignedBigInteger('commenter_model_id')->nullable();
			$table->string('upon_model_type');
			$table->unsignedBigInteger('upon_model_id');
			$table->text('comment');
			$table->unsignedBigInteger('created_by')->comment('user_id');
			$table->unsignedBigInteger('closed_by')->nullable()->comment('user_id');
			$table->datetime('closed_at')->nullable();
			$table->text('closed_comment')->nullable();
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
		Schema::dropIfExists('complaints');
	}
}
