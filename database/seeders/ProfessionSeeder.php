<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Profession;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

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
