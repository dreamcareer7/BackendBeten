<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\{Contract, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any contracts.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user): bool
	{
		return $user->can('contracts.index');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Contract $contract
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(User $user, Contract $contract): bool
	{
		return $user->can('contracts.view');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function create(User $user): bool
	{
		return $user->can('contracts.create');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Contract $contract
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(User $user, Contract $contract): bool
	{
		return $user->can('contracts.edit');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Contract $contract
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(User $user, Contract $contract): bool
	{
		return $user->can('contracts.delete');
	}
}
