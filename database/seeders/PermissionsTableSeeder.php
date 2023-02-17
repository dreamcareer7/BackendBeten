<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

use Spatie\Permission\PermissionRegistrar;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

		$permissions = [

			'users.create',
			'users.edit',
			'users.status',
			'users.editOwn',
			'users.delete',
			'users.deleteOwn',
			'users.view',
			'users.browse',
			'users.*', // dummy as https://github.com/spatie/laravel-permission/issues/1423

			'roles.create',
			'roles.edit',
			'roles.delete',
			'roles.*',

			'settings.general',
			'settings.*',
		];

		foreach( $permissions as $permit )
			Permission::create(['name' => $permit]);
    }

}
