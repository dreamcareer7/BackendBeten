<?php

declare(strict_types=1);

namespace Database\Seeders;

use Faker\Factory as Faker;

use Illuminate\Database\Seeder;
use App\Models\{Profession, User};
use Spatie\Permission\Models\{Permission, Role};

class ProfessionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Profession::truncate();
		$faker = Faker::create();
		$min = 1;
		$max = 5;
		foreach (range($min,$max) as $index) {
			Profession::create([
				'id' => $faker->unique()->numberBetween($min,$max),
				'title' => $faker->jobTitle,
			]);
		}
	}
}
