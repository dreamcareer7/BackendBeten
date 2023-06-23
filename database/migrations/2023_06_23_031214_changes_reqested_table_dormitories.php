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
		$schema->create('dormitories', function (Blueprint $table) {
			
			$table->unsignedBigInteger('HOUSE_ID')->nullable()->after('is_active');
			$table->string('HOUSE_COMMERCIAL_NAME_AR')->nullable()->after('is_active');
			$table->string('HOUSE_COMMERCIAL_NAME_LA')->nullable()->after('is_active');
			$table->unsignedBigInteger('HOUSE_CITY_ID')->nullable()->after('is_active');
			$table->unsignedInteger('HOUSE_TOTAL_ROOMS')->nullable()->after('is_active');
			$table->unsignedInteger('HOUSE_GUEST_CAPACITY')->nullable()->after('is_active');
			$table->string('HOUSE_MAP_ADDRESS_LATITUDE')->nullable()->after('is_active');
			$table->string('HOUSE_MAP_ADDRESS_LONGITUDE')->nullable()->after('is_active');
			$table->string('HOUSE_ADDRESS_1')->nullable()->after('is_active');
			$table->string('HOUSE_PHONES_NO')->nullable()->after('is_active');
			$table->string('HOUSE_MANAGER_NAME')->nullable()->after('is_active');
			$table->string('HOUSE_MANAGER_PHONE')->nullable()->after('is_active');
			$table->unsignedInteger('HOUSE_RENEWAL_SEASON')->nullable()->after('is_active');
			
		});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
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
    }
};
