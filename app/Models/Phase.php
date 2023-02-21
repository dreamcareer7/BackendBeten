<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;
    protected $fillable=["title"];

    public function services(){
        return $this->hasMany(PhaseService::class,'id','phase_id');
    }
}
