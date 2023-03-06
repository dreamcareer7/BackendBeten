<?php

declare(strict_types=1);

namespace Database\Seeders;

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
	public function run(): void
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
			'roles.assigning_permissions',
			'roles.assigning_users',
			'roles.delete',
			'roles.*',

			'crew.index',
			'crew.create',
			'crew.edit',
			'crew.delete',
			'crew.view',

			'services.index',
			'services.create',
			'services.edit',
			'services.delete',
			'services.view',

			'vehicles.index',
			'vehicles.create',
			'vehicles.edit',
			'vehicles.delete',
			'vehicles.view',

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

			'documents.index',
			'documents.create',
			'documents.edit',
			'documents.delete',
			'documents.view',

			'contracts.index',
			'contracts.create',
			'contracts.edit',
			'contracts.delete',
			'contracts.view',

			'complaints.index',
			'complaints.create',
			'complaints.edit',
			'complaints.delete',
			'complaints.view',

			'settings.general',
			'settings.*',
		];

		foreach ($permissions as $permit) {
			Permission::create(['name' => $permit]);
		}
	}
}
