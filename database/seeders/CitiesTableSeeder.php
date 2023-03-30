<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		City::create([
			'title' => 'مكة المكرمة',
		]);
		City::create([
			'title' => 'المدينة المنورة',
		]);
		City::factory()->count(count: 20)->create();
	}
}
