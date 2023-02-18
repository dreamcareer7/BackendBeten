<?php

namespace App\Models;

use App\Http\Controllers\API\API\API\API\API\API\API\API\SubscriptionController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function subscriptions(){
        return $this->hasMany(SubscriptionController::class);
    }
}
