<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\{Country, User};

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};

class CountrySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$json = file_get_contents(database_path('countries.json'));
		$countries = json_decode($json, true);

		foreach ($countries as $country) {
			Country::updateOrCreate(['id' => $country['id']], [
				'id' => $country['id'],
				'name' => $country['name'],
				'code' => $country['code']
			]);
		}
	}

}
