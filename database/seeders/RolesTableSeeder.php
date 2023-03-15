<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(): void
	{
		Role::create(['name' => 'admin']);
		$roleSuperVisor = Role::create(['name' => 'supervisor']);
		$roleGroupsAdmin = Role::create(['name' => 'groups-admin']);
		Role::create(['name' => 'user']);
		$roleMember = Role::create(['name' => 'member']);
		$roleSuperVisor->givePermissionTo([
			'users.create',
			'users.edit',
			'users.status',
			'users.editOwn',
			'users.delete',
			'users.deleteOwn',
			'users.view',
			'users.browse',
			'users.*',

			'crew.index',
			'crew.create',
			'crew.edit',
			'crew.delete',
			'crew.view',

			'vehicles.index',
			'vehicles.create',
			'vehicles.edit',
			'vehicles.delete',
			'vehicles.view',

			'clients.index',
			'clients.create',
			'clients.edit',
			'clients.delete',
			'clients.view',
		]);
		$roleGroupsAdmin->givePermissionTo([
			'groups.index',
			'groups.create',
			'groups.edit',
			'groups.delete',
			'groups.view',

			'clients.index',
			'clients.create',
			'clients.edit',
			'clients.delete',
			'clients.view',
		]);
		$roleMember->givePermissionTo([
			'users.view',
			'users.browse',
			'users.*',

			'crew.index',
			'crew.view',

			'vehicles.index',
			'vehicles.view',
		]);
	}
}
