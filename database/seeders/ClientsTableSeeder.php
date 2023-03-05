<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\{Client, Group};
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		Client::factory(count: 20)->create()
			->each(function (Client $client): void {
					$client->groups()->attach(
						Group::inRandomOrder()
							->limit(3)
							->select('id')
							->pluck('id')
							->toArray()
					);
				}
			);
	}
}
