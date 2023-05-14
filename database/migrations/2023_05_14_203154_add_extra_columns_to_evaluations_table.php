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
        Schema::table('evaluations', function (Blueprint $table) {
            $table->string('voter_model_type')->nullable();
            $table->unsignedBigInteger('voter_model_id')->nullable();
            $table->float('vote')->nullable();
            $table->text('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropColumn('voter_model_type');
            $table->dropColumn('voter_model_id');
            $table->dropColumn('vote');
            $table->dropColumn('note');
        });
    }
};
