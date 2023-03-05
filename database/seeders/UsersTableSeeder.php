<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		// Seed static email admin user for easier development
		User::factory()->create([
			'name' => 'Dr. Imad',
			'email' => 'admin@murafiq.com',
			'is_active' => true,
		])->assignRole('admin');

		User::factory()->count(20)->hasCrew()->create();
	}
}
