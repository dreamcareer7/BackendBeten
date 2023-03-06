<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\{Group, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any groups.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user): bool
	{
		return $user->can('groups.index');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Group $group
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(User $user, Group $group): bool
	{
		return $user->can('groups.view');
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
		return $user->can('groups.create');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Group $group
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(User $user, Group $group): bool
	{
		return $user->can('groups.edit');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Group $group
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(User $user, Group $group): bool
	{
		return $user->can('groups.delete');
	}
}
