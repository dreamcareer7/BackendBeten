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
        Schema::create('service_commit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_commit_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            // TODO: add the other roles to the enum
            $table->enum('roles', ['admin', 'member']);
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
        Schema::dropIfExists('service_commit_logs');
    }
};
