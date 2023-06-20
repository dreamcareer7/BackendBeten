<?php

namespace Database\Seeders;

use App\Models\ServiceCenter;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //title	phone	location	group	maxClientCount
        ServiceCenter::create([
            'title' => 'Test Title',
            'phone' => '123456789',
            'location'=>'test location',
            'group'=>'Test group',
            'maxClientCount'=>'10',
        ]);
    }
}
