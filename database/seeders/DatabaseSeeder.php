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
			CrewMembersTableSeeder::class,
			GroupsTableSeeder::class,
			HospitalitiesTableSeeder::class,
			ServicesTableSeeder::class,
			PhasesTableSeeder::class,
			MealTypesTableSeeder::class,
			MealsTableSeeder::class,
			ProfessionSeeder::class,
			CountrySeeder::class,
			ClientsTableSeeder::class,
			PermissionsTableSeeder::class,
			RolesTableSeeder::class,
			UsersTableSeeder::class,
			DormitoriesTableSeeder::class,
		]);
		Vehicle::factory()->create();
	}
}
