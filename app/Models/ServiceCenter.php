<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCenter extends Model
{
	use HasFactory;

	protected $fillable = ['title', 'phone', 'location', 'group', 'maxClientCount'];

    public function deleteUserByServiceCenterId($service_center_id)
    {
        $this->where('service_center_id', $service_center_id)->delete();
    }

    public function user(){
        return $this->hasOne(User::class,'service_center_id');
    }
}
