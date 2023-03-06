<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\{Document, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any documents.
	 *
	 * @param \App\Models\User $user
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function viewAny(User $user): bool
	{
		return $user->can('documents.index');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Document $document
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function view(User $user, Document $document): bool
	{
		return $user->can('documents.view');
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
		return $user->can('documents.create');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Document $document
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function update(User $user, Document $document): bool
	{
		return $user->can('documents.edit');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Document $document
	 *
	 * @return \Illuminate\Auth\Access\Response|bool
	 */
	public function delete(User $user, Document $document): bool
	{
		return $user->can('documents.delete');
	}
}
