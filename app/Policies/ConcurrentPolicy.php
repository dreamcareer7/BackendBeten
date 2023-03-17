<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\{Concurrent, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class ConcurrentPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any concurrents.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user): bool
	{
		return $user->can('concurrents.index');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Concurrent $concurrent
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(User $user, Concurrent $concurrent): bool
	{
		return $user->can('concurrents.view');
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
		return $user->can('concurrents.create');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Concurrent $concurrent
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(User $user, Concurrent $concurrent): bool
	{
		return $user->can('concurrents.edit');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Concurrent $concurrent
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(User $user, Concurrent $concurrent): bool
	{
		return $user->can('concurrents.delete');
	}
}
