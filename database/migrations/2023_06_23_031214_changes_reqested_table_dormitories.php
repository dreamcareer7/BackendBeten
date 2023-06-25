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
        Schema::table('dormitories', function (Blueprint $table) {

            $table->unsignedBigInteger('HOUSE_ID')->nullable();
            $table->string('HOUSE_COMMERCIAL_NAME_AR')->nullable();
            $table->string('HOUSE_COMMERCIAL_NAME_LA')->nullable();
            $table->unsignedBigInteger('HOUSE_CITY_ID')->nullable();
            $table->unsignedInteger('HOUSE_TOTAL_ROOMS')->nullable();
            $table->unsignedInteger('HOUSE_GUEST_CAPACITY')->nullable();
            $table->string('HOUSE_MAP_ADDRESS_LATITUDE')->nullable();
            $table->string('HOUSE_MAP_ADDRESS_LONGITUDE')->nullable();
            $table->string('HOUSE_ADDRESS_1')->nullable();
            $table->string('HOUSE_PHONES_NO')->nullable();
            $table->string('HOUSE_MANAGER_NAME')->nullable();
			$table->string('HOUSE_MANAGER_PHONE')->nullable();
			$table->unsignedInteger('HOUSE_RENEWAL_SEASON')->nullable();

		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dormitories', function (Blueprint $table) {

            $table->dropColumn('HOUSE_ID');
            $table->dropColumn('HOUSE_COMMERCIAL_NAME_AR');
            $table->dropColumn('HOUSE_COMMERCIAL_NAME_LA');
            $table->dropColumn('HOUSE_CITY_ID');
            $table->dropColumn('HOUSE_TOTAL_ROOMS');
            $table->dropColumn('HOUSE_GUEST_CAPACITY');
            $table->dropColumn('HOUSE_MAP_ADDRESS_LATITUDE');
            $table->dropColumn('HOUSE_MAP_ADDRESS_LONGITUDE');
            $table->dropColumn('HOUSE_ADDRESS_1');
            $table->dropColumn('HOUSE_PHONES_NO');
            $table->dropColumn('HOUSE_MANAGER_NAME');
            $table->dropColumn('HOUSE_MANAGER_PHONE');
            $table->dropColumn('HOUSE_RENEWAL_SEASON');
        });
    }
};
