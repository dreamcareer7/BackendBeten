<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		User::truncate(); // Remove all existing users
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
		User::factory()->count(5000)->create()
			->each(fn (User $user) => $user->assignRole('admin'));

		// Seed static email admin user for easier development
		User::factory()->create([
			'name' => 'Dr. Imad',
			'email' => 'admin@murafiq.com',
		])->assignRole('admin');
	}
}
