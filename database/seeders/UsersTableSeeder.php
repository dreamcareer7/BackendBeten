<?php

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
        User::truncate(); // Remove all existing users
        User::factory()->count(3)->create()
            ->each(fn (User $user) => $user->assignRole('admin'));

        // Seed static email admin user for easier development
        User::factory()->create([
            'email' => 'admin@murafiq.com',
        ])->assignRole('admin');
    }
}
