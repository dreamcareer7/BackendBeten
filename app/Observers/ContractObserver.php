<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Contract;

class ContractObserver
{
	/**
	 * Handle the Contract "created" event.
	 *
	 * @param  \App\Models\Contract  $contract
	 * @return void
	 */
	public function created(Contract $contract)
	{
		//
	}

	/**
	 * Handle the Contract "updated" event.
	 *
	 * @param  \App\Models\Contract  $contract
	 * @return void
	 */
	public function updated(Contract $contract)
	{
		//
	}

	/**
	 * Handle the Contract "deleted" event.
	 *
	 * @param  \App\Models\Contract  $contract
	 * @return void
	 */
	public function deleted(Contract $contract)
	{
		//
	}

	/**
	 * Handle the Contract "restored" event.
	 *
	 * @param  \App\Models\Contract  $contract
	 * @return void
	 */
	public function restored(Contract $contract)
	{
		//
	}

	/**
	 * Handle the Contract "force deleted" event.
	 *
	 * @param  \App\Models\Contract  $contract
	 * @return void
	 */
	public function forceDeleted(Contract $contract)
	{
		//
	}
}
