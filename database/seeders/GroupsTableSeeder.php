<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\{Client, Group};
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		Group::factory(count: 20)
			->has(factory: Client::factory()->count(6))
			->create();
	}
}
