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
		// We should probably seed client_languages before seeding clients
		// At the moment the two tables are not related
		$this->call([
			MealTypesTableSeeder::class,
			ProfessionSeeder::class,
			CountrySeeder::class,
			ClientsTableSeeder::class,
			PermissionsTableSeeder::class,
			RolesTableSeeder::class,
			UsersTableSeeder::class,
		]);
		Crew::factory()->create();
		Vehicle::factory()->create();
		City::factory()->count(count: 5)->create();
		Dormitory::factory()->create();
		Group::factory()->create();
	}
}
