<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\{City, Vehicle};
use Illuminate\Database\Seeder;

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
		City::factory()->count(count: 20)->create();
		$this->call([
			PermissionsTableSeeder::class,
			RolesTableSeeder::class,
			CountrySeeder::class,
			UsersTableSeeder::class, // Also seeds crew member
			GroupsTableSeeder::class,
			HospitalitiesTableSeeder::class,
			ServicesTableSeeder::class,
			PhasesTableSeeder::class,
			MealTypesTableSeeder::class,
			MealsTableSeeder::class,
			ProfessionSeeder::class,
			ClientsTableSeeder::class,
			DormitoriesTableSeeder::class,
		]);
		Vehicle::factory()->create();
	}
}
