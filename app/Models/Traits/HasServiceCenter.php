<?php

declare(strict_types=1);

namespace App\Models\Traits;

//use App\Exceptions\MissingServiceCenterException;
use App\Models\ServiceCenter;
use Illuminate\Database\Eloquent\{Builder, Model};

trait HasServiceCenter
{
	/**
	 * Boot the trait.
	 */
	protected static function bootHasServiceCenter()
	{
		static::addGlobalScope('serviceCenter', function (Builder $query) {
			if ($serviceCenterID = auth()->user()?->service_center_id) {
			  if ( auth()->user()?->service_center_id  > 1 )  // because service center id 1 is administration
				$query->where('service_center_id', $serviceCenterID);
			  else
				$query->whereNotNull('service_center_id');
			}
		});

		static::creating(function (Model $model) {
			if (empty($model->service_center_id)) {
				$serviceCenterID = auth()->user()?->service_center_id;

				if (is_null($serviceCenterID)) {
					// Feel free to just use a standard `\Exception` here.
					//throw new MissingServiceCenterException($model);
					throw new Exception('Unknown service center', 32001);                    
				}

				$model->service_center_id = $serviceCenterID;
			}
		});
	}

	public function serviceCenter()
	{
		return $this->belongsTo(ServiceCenter::class);
	}
  
}

