<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Country;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Country::truncate();
        $faker = Faker::create();
        $min = 1;
        $max = 5;
        foreach (range($min,$max) as $index) {
            Country::create([
                'id' => $faker->unique()->numberBetween($min,$max),
                'title' => $faker->country,
            ]);
        }
    }
}
