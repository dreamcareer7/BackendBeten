<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ServiceCenter;

use Illuminate\Database\Seeder;

class ServiceCentersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		ServiceCenter::create(['title'=>'الادارة', 'phone'=>'5445150', 'group'=>'', 'maxClientCount'=>0,'location'=>'مكة المكرمة']);
	}
}
