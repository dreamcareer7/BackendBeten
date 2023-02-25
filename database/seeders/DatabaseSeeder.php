<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Crew;
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
		$this->call([
			ProfessionSeeder::class,
			CountrySeeder::class,
			PermissionsTableSeeder::class,
			RolesTableSeeder::class,
			UsersTableSeeder::class,
		]);
		Crew::factory()->create();
	}
}
