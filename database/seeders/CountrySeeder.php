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
        $json = file_get_contents(database_path('countries.json'));
        $countries = json_decode($json, true);

        foreach ($countries as $country) {
            Country::updateOrCreate(['id' => $country['id']], [
                'id' => $country['id'],
                'name' => $country['name'],
                'code' => $country['code']
            ]);
        }
    }

}
