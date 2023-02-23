<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCommitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_commits', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('service_id');
			$table->string('badge');
			$table->datetime('scheduled_at')->nullable();
			$table->datetime('started_at')->nullable();
			$table->string('location');
			$table->unsignedBigInteger('supervisor_id')->comment('crew_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('crews');

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
        Schema::dropIfExists('service__commits');
    }
}
