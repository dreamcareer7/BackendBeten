<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{City, Crew, Dormitory, Group, Meal, Vehicle};

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run(): void
	{
		$this->call([
			ProfessionSeeder::class,
			CountrySeeder::class,
			PermissionsTableSeeder::class,
			RolesTableSeeder::class,
			UsersTableSeeder::class,
		]);
		Crew::factory()->create();
		Vehicle::factory()->create();
		City::create([
			'title' => 'Makkah',
		]);
		Dormitory::factory()->create();
		Meal::factory()->create();
		Group::factory()->create();
	}
}
