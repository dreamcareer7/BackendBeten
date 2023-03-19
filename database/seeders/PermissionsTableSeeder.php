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
			'users.view',
			'users.browse',
			// dummy as https://github.com/spatie/laravel-permission/issues/1423
			'users.*',

			'users.documents.view',

			'roles.create',
			'roles.edit',
			'roles.*',

			'crew.index',
			'crew.create',
			'crew.edit',
			'crew.view',
			'crew.*',

			'crew.documents.view',
			'crew.documents.delete',
			'crew.documents.add',
			'crew.documents.*',

			'crew.contracts.view',
			'crew.contracts.add',
			'crew.contracts.*',

			'services.index',
			'services.create',
			'services.edit',
			'services.view',

			'vehicles.index',
			'vehicles.create',
			'vehicles.edit',
			'vehicles.view',
			'vehicles.*',

			'vehicles.documents.view',
			'vehicles.documents.delete',
			'vehicles.documents.add',
			'vehicles.documents.*',

			'vehicles.contracts.view',
			'vehicles.contracts.delete',
			'vehicles.contracts.add',
			'vehicles.contracts.*',

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
			'clients.*',

			'clients.documents.view',
			'clients.documents.delete',
			'clients.documents.add',
			'clients.documents.*',

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
			'settings.index',
			'settings.edit',
			'settings.*',
		];

		foreach ($permissions as $permit) {
			Permission::create(['name' => $permit]);
		}
	}
}
