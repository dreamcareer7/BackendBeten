<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::truncate();
        $faker = Faker::create();

        foreach (range(1,3) as $index) {
            $adminUser = User::create([
                            'name' => $faker->name,
                            'is_active'=>1,
                            'username' => $faker->userName,
                            'contact' => config('eogsoft.contact'),
                            'password'=> Hash::make( 'password' ), // This password can not be accessed
                        ]);
            $adminUser->assignRole('admin');
        }
    }
}
