<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	public function up()
	{
		Schema::table('countries', function (Blueprint $table) {
			if (Schema::hasColumn('countries', 'title')) {
				$table->renameColumn('title', 'name');
			}

			if (! Schema::hasColumn('countries', 'code')) {
				$table->string('code', 5)->after('id')->nullable();
			}
		});
	}

	public function down()
	{
		Schema::table('countries', function (Blueprint $table) {
			if (Schema::hasColumn('countries', 'name')) {
				$table->renameColumn('name', 'title');
			}

			if (Schema::hasColumn('countries', 'code')) {
				$table->dropColumn('code');
			}

		});
	}
};
