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
			'email' => '1000000000',
			'is_active' => true,
			'service_center_id'=>1,
		])->assignRole('admin');

		User::factory()->create([
			'email' => '1000000001',
			'is_active' => true,
			'service_center_id'=>1,
		])->assignRole('supervisor');

		User::factory()->create([
			'email' => '1000000002',
			'is_active' => true,
			'service_center_id'=>1,
		])->assignRole('groups-admin');

		User::factory()->create([
			'email' => '1000000003',
			'is_active' => true,
			'service_center_id'=>1,
		])->assignRole('member');

		//User::factory()->count(20)->hasCrew()->create();
	}
}
