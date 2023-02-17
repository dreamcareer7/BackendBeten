<?php

namespace App\Models;

use App\Http\Controllers\SubscriptionController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function subscriptions(){
        return $this->hasMany(SubscriptionController::class);
    }
}
