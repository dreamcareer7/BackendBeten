<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use App\Models\Grammar\ExtendedMySQLGrammar;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Database\Migrations\Migration;

class CreateDormitoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		DB::connection()->setSchemaGrammar(new ExtendedMySQLGrammar());
		$schema = DB::connection()->getSchemaBuilder();
		$schema->create('dormitories', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('phones');
			$table->unsignedBigInteger('city_id');
			$table->foreign('city_id')->references('id')->on('cities');
			$table->string('location');
			$table->geometry('coordinate')->nullable()->comment('json of geometry');
			$table->boolean('is_active')->default(true);

			$table->softDeletes();
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
		Schema::dropIfExists('dormitories');
	}
}
