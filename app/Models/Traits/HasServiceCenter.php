<?php
namespace App\Models\Traits;
declare(strict_types=1);

use App\Exceptions\MissingOrganisationException;
use App\Models\ServiceCenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasServiceCenter
{
    /**
     * Boot the trait.
     */
    protected static function bootHasServiceCenter()
    {
        static::addGlobalScope('serviceCenter', function (Builder $query) {
            if ($serviceCenterID = auth()->user()?->service_center_id) {
              //if ( ! auth()->user()->hasAnyRole(json_encode(array_values(config('eogsoft.superadmins')))) ) 
                $query->where('service_center_id', $serviceCenterID);
            }
        });

        static::creating(function (Model $model) {
            if (empty($model->service_center_id)) {
                $serviceCenterID = auth()->user()?->service_center_id;

                if (is_null($serviceCenterID)) {
                    // Feel free to just use a standard `\Exception` here.
                    throw new MissingServiceCenterException($model);
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

