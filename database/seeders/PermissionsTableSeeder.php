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

		$entities = [
			'clients',
			'commits',
			'crews',
			'dormitories',
			'groups',
			'hospitalities',
			'logs',
			'meals',
			'phases',
			'services',
			'transactions',
			'types',
			'users',
			'vehicles',
		];

		$relatables = [
			'contracts',
			'documents',
			'concurrents',
		];

		$actions = [
			'index',
			'view',
			'create',
			'edit',
			'delete',
			'*',
		];

		foreach ($entities as $entity) {
			foreach ($actions as $action) {
				Permission::create(['name' => $entity . '.' . $action]);
				foreach ($relatables as $relatable) {
					Permission::create([
						'name' => $entity . '.' . $relatable . '.' . $action,
					]);
				}
			}
		}
	}
}
