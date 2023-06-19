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
		
		$permissions = $this->permissions();
		
		Permission::create(['name' => '*.*']);
		
		foreach($permission as $permission)
			Permission::create(['name' => $permission]);
		
		
		return true;
		//--------------------- Above made to make permissions more clear -------------------
		Permission::create(['name' => '*.*']);

		$entities = [
			'clients',
			'service_commits',
			'complaints',
			'crews',
			'dormitories',
			'evaluations',
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
			'roles',
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
				if ($entity != 'roles') {
					foreach ($relatables as $relatable) {
						Permission::create([
							'name' => $entity . '.' . $relatable . '.' . $action,
						]);
					}
				}
			}
		}

		foreach ([
			'user_logs.view',
			'user_logs.index',
			'users_dataentry.view',
			'users_dataentry.index',
			'settings.view',
			'settings.edit',
			'settings.index',
		] as $permission) {
			Permission::create(['name' => $permission]);
		}

		Permission::create(['name' => 'groups.clients.add']);
		Permission::create(['name' => 'groups.clients.remove']);
		Permission::create(['name' => 'service_commits.initialize']);
		Permission::create(['name' => 'service_commits.release']);
	}
	
	private function permissions()
	{
		return [
'clients.*'
'clients.concurrents.*'
'clients.concurrents.create'
'clients.concurrents.delete'
'clients.concurrents.edit'
'clients.concurrents.index'
'clients.concurrents.view'
'clients.contracts.*'
'clients.contracts.create'
'clients.contracts.delete'
'clients.contracts.edit'
'clients.contracts.index'
'clients.contracts.view'
'clients.create'
'clients.delete'
'clients.documents.*'
'clients.documents.create'
'clients.documents.delete'
'clients.documents.edit'
'clients.documents.index'
'clients.documents.view'
'clients.edit'
'clients.index'
'clients.view'
'complaints.*'
'complaints.concurrents.*'
'complaints.concurrents.create'
'complaints.concurrents.delete'
'complaints.concurrents.edit'
'complaints.concurrents.index'
'complaints.concurrents.view'
'complaints.contracts.*'
'complaints.contracts.create'
'complaints.contracts.delete'
'complaints.contracts.edit'
'complaints.contracts.index'
'complaints.contracts.view'
'complaints.create'
'complaints.delete'
'complaints.documents.*'
'complaints.documents.create'
'complaints.documents.delete'
'complaints.documents.edit'
'complaints.documents.index'
'complaints.documents.view'
'complaints.edit'
'complaints.index'
'complaints.view'
'crews.*'
'crews.concurrents.*'
'crews.concurrents.create'
'crews.concurrents.delete'
'crews.concurrents.edit'
'crews.concurrents.index'
'crews.concurrents.view'
'crews.contracts.*'
'crews.contracts.create'
'crews.contracts.delete'
'crews.contracts.edit'
'crews.contracts.index'
'crews.contracts.view'
'crews.create'
'crews.delete'
'crews.documents.*'
'crews.documents.create'
'crews.documents.delete'
'crews.documents.edit'
'crews.documents.index'
'crews.documents.view'
'crews.edit'
'crews.index'
'crews.view'
'dormitories.*'
'dormitories.concurrents.*'
'dormitories.concurrents.create'
'dormitories.concurrents.delete'
'dormitories.concurrents.edit'
'dormitories.concurrents.index'
'dormitories.concurrents.view'
'dormitories.contracts.*'
'dormitories.contracts.create'
'dormitories.contracts.delete'
'dormitories.contracts.edit'
'dormitories.contracts.index'
'dormitories.contracts.view'
'dormitories.create'
'dormitories.delete'
'dormitories.documents.*'
'dormitories.documents.create'
'dormitories.documents.delete'
'dormitories.documents.edit'
'dormitories.documents.index'
'dormitories.documents.view'
'dormitories.edit'
'dormitories.index'
'dormitories.view'
'evaluations.*'
'evaluations.concurrents.*'
'evaluations.concurrents.create'
'evaluations.concurrents.delete'
'evaluations.concurrents.edit'
'evaluations.concurrents.index'
'evaluations.concurrents.view'
'evaluations.contracts.*'
'evaluations.contracts.create'
'evaluations.contracts.delete'
'evaluations.contracts.edit'
'evaluations.contracts.index'
'evaluations.contracts.view'
'evaluations.create'
'evaluations.delete'
'evaluations.documents.*'
'evaluations.documents.create'
'evaluations.documents.delete'
'evaluations.documents.edit'
'evaluations.documents.index'
'evaluations.documents.view'
'evaluations.edit'
'evaluations.index'
'evaluations.view'
'groups.*'
'groups.clients.add'
'groups.clients.remove'
'groups.concurrents.*'
'groups.concurrents.create'
'groups.concurrents.delete'
'groups.concurrents.edit'
'groups.concurrents.index'
'groups.concurrents.view'
'groups.contracts.*'
'groups.contracts.create'
'groups.contracts.delete'
'groups.contracts.edit'
'groups.contracts.index'
'groups.contracts.view'
'groups.create'
'groups.delete'
'groups.documents.*'
'groups.documents.create'
'groups.documents.delete'
'groups.documents.edit'
'groups.documents.index'
'groups.documents.view'
'groups.edit'
'groups.index'
'groups.view'
'hospitalities.*'
'hospitalities.concurrents.*'
'hospitalities.concurrents.create'
'hospitalities.concurrents.delete'
'hospitalities.concurrents.edit'
'hospitalities.concurrents.index'
'hospitalities.concurrents.view'
'hospitalities.contracts.*'
'hospitalities.contracts.create'
'hospitalities.contracts.delete'
'hospitalities.contracts.edit'
'hospitalities.contracts.index'
'hospitalities.contracts.view'
'hospitalities.create'
'hospitalities.delete'
'hospitalities.documents.*'
'hospitalities.documents.create'
'hospitalities.documents.delete'
'hospitalities.documents.edit'
'hospitalities.documents.index'
'hospitalities.documents.view'
'hospitalities.edit'
'hospitalities.index'
'hospitalities.view'
'logs.*'
'logs.concurrents.*'
'logs.concurrents.create'
'logs.concurrents.delete'
'logs.concurrents.edit'
'logs.concurrents.index'
'logs.concurrents.view'
'logs.contracts.*'
'logs.contracts.create'
'logs.contracts.delete'
'logs.contracts.edit'
'logs.contracts.index'
'logs.contracts.view'
'logs.create'
'logs.delete'
'logs.documents.*'
'logs.documents.create'
'logs.documents.delete'
'logs.documents.edit'
'logs.documents.index'
'logs.documents.view'
'logs.edit'
'logs.index'
'logs.view'
'meals.*'
'meals.concurrents.*'
'meals.concurrents.create'
'meals.concurrents.delete'
'meals.concurrents.edit'
'meals.concurrents.index'
'meals.concurrents.view'
'meals.contracts.*'
'meals.contracts.create'
'meals.contracts.delete'
'meals.contracts.edit'
'meals.contracts.index'
'meals.contracts.view'
'meals.create'
'meals.delete'
'meals.documents.*'
'meals.documents.create'
'meals.documents.delete'
'meals.documents.edit'
'meals.documents.index'
'meals.documents.view'
'meals.edit'
'meals.index'
'meals.view'
'phases.*'
'phases.concurrents.*'
'phases.concurrents.create'
'phases.concurrents.delete'
'phases.concurrents.edit'
'phases.concurrents.index'
'phases.concurrents.view'
'phases.contracts.*'
'phases.contracts.create'
'phases.contracts.delete'
'phases.contracts.edit'
'phases.contracts.index'
'phases.contracts.view'
'phases.create'
'phases.delete'
'phases.documents.*'
'phases.documents.create'
'phases.documents.delete'
'phases.documents.edit'
'phases.documents.index'
'phases.documents.view'
'phases.edit'
'phases.index'
'phases.view'
'roles.*'
'roles.create'
'roles.delete'
'roles.edit'
'roles.index'
'roles.view'
'service_commits.*'
'service_commits.concurrents.*'
'service_commits.concurrents.create'
'service_commits.concurrents.delete'
'service_commits.concurrents.edit'
'service_commits.concurrents.index'
'service_commits.concurrents.view'
'service_commits.contracts.*'
'service_commits.contracts.create'
'service_commits.contracts.delete'
'service_commits.contracts.edit'
'service_commits.contracts.index'
'service_commits.contracts.view'
'service_commits.create'
'service_commits.delete'
'service_commits.documents.*'
'service_commits.documents.create'
'service_commits.documents.delete'
'service_commits.documents.edit'
'service_commits.documents.index'
'service_commits.documents.view'
'service_commits.edit'
'service_commits.index'
'service_commits.initialize'
'service_commits.release'
'service_commits.view'
'services.*'
'services.concurrents.*'
'services.concurrents.create'
'services.concurrents.delete'
'services.concurrents.edit'
'services.concurrents.index'
'services.concurrents.view'
'services.contracts.*'
'services.contracts.create'
'services.contracts.delete'
'services.contracts.edit'
'services.contracts.index'
'services.contracts.view'
'services.create'
'services.delete'
'services.documents.*'
'services.documents.create'
'services.documents.delete'
'services.documents.edit'
'services.documents.index'
'services.documents.view'
'services.edit'
'services.index'
'services.view'
'settings.edit'
'settings.index'
'settings.view'
'transactions.*'
'transactions.concurrents.*'
'transactions.concurrents.create'
'transactions.concurrents.delete'
'transactions.concurrents.edit'
'transactions.concurrents.index'
'transactions.concurrents.view'
'transactions.contracts.*'
'transactions.contracts.create'
'transactions.contracts.delete'
'transactions.contracts.edit'
'transactions.contracts.index'
'transactions.contracts.view'
'transactions.create'
'transactions.delete'
'transactions.documents.*'
'transactions.documents.create'
'transactions.documents.delete'
'transactions.documents.edit'
'transactions.documents.index'
'transactions.documents.view'
'transactions.edit'
'transactions.index'
'transactions.view'
'types.*'
'types.concurrents.*'
'types.concurrents.create'
'types.concurrents.delete'
'types.concurrents.edit'
'types.concurrents.index'
'types.concurrents.view'
'types.contracts.*'
'types.contracts.create'
'types.contracts.delete'
'types.contracts.edit'
'types.contracts.index'
'types.contracts.view'
'types.create'
'types.delete'
'types.documents.*'
'types.documents.create'
'types.documents.delete'
'types.documents.edit'
'types.documents.index'
'types.documents.view'
'types.edit'
'types.index'
'types.view'
'user_logs.index'
'user_logs.view'
'users_dataentry.index'
'users_dataentry.view'
'users.*'
'users.concurrents.*'
'users.concurrents.create'
'users.concurrents.delete'
'users.concurrents.edit'
'users.concurrents.index'
'users.concurrents.view'
'users.contracts.*'
'users.contracts.create'
'users.contracts.delete'
'users.contracts.edit'
'users.contracts.index'
'users.contracts.view'
'users.create'
'users.delete'
'users.documents.*'
'users.documents.create'
'users.documents.delete'
'users.documents.edit'
'users.documents.index'
'users.documents.view'
'users.edit'
'users.index'
'users.view'
'vehicles.*'
'vehicles.concurrents.*'
'vehicles.concurrents.create'
'vehicles.concurrents.delete'
'vehicles.concurrents.edit'
'vehicles.concurrents.index'
'vehicles.concurrents.view'
'vehicles.contracts.*'
'vehicles.contracts.create'
'vehicles.contracts.delete'
'vehicles.contracts.edit'
'vehicles.contracts.index'
'vehicles.contracts.view'
'vehicles.create'
'vehicles.delete'
'vehicles.documents.*'
'vehicles.documents.create'
'vehicles.documents.delete'
'vehicles.documents.edit'
'vehicles.documents.index'
'vehicles.documents.view'
'vehicles.edit'
'vehicles.index'
'vehicles.view'		
		];
	}
}
