<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Crew, Dormitory, Vehicle};

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
		Dormitory::factory()->create();
	}
}
