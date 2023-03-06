<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\{Crew, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class CrewPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any crews.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user): bool
	{
		return $user->can('crew.index');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Crew $crew
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(User $user, Crew $crew): bool
	{
		return $user->can('crew.view');
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
		return $user->can('crew.create');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Crew $crew
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(User $user, Crew $crew): bool
	{
		return $user->can('crew.edit');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Crew $crew
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(User $user, Crew $crew): bool
	{
		return $user->can('crew.delete');
	}

	/**
	 * Determine whether the user can restore the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Crew $crew
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function restore(User $user, Crew $crew): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Crew $crew
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function forceDelete(User $user, Crew $crew): bool
	{
		return false;
	}
}
