<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseService extends Model
{
    use HasFactory;
    protected $fillable=[
        "phase_id","service_id"
    ];

    public function service(){
        return $this->hasOne('services','id','service_id');
    }
    public function phase(){
        return $this->hasOne('phases','id','phase_id');

    }
}
