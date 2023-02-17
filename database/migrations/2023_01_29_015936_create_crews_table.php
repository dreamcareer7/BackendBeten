<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crews', function (Blueprint $table) {
            $table->id();
			$table->string('fullname')->comment('name in arabic language');
			$table->boolean('gender')->default('0')->comment('0->male, 1->female');
			$table->unsignedTinyInteger('profession_id')->nullable();
			$table->unsignedTinyInteger('country_id');
			$table->string('phone');
			$table->string('id_type');
			$table->string('id_no');
			$table->date('dob');
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
    public function down()
    {
        Schema::dropIfExists('crews');
    }
}
