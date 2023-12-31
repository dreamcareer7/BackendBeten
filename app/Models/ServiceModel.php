<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\ServiceModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceModel query()
 * @mixin \Eloquent
 */
class ServiceModel extends Model
{
	use HasFactory;

	public function insertServiceModels($service_id, $model_ids): void
	{
		$insertData = [];
		$current_datetime = now();
		if (!empty($model_ids)) {
			foreach ($model_ids as $m_id) {
				$insertData[] = [
					'service_id' => $service_id,
					'model_id' => $m_id,
					'created_at' => $current_datetime,
					'updated_at' => $current_datetime,
				];
			}

			if (!empty($insertData)) {
				self::insert($insertData);
			}
		}
	}

	public function deleteByServiceId($service_id)
	{
		$this->where('service_id', $service_id)->delete();
	}

	public function updateServiceModels($service_id, $model_ids): void
	{
		$this->deleteByServiceId($service_id);
		$this->insertServiceModels($service_id, $model_ids);
	}

	public function getServiceModelsByServiceId($service_id)
	{
		return $this->where('service_id', $service_id)->pluck('model_id');
	}

}
