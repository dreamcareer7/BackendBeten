<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=[
      "title",
      "crew_id"
    ];

    public function crew(){
        return $this->hasOne(Crew::class,'id','crew_id');
    }
    public function clients(){
        return $this->hasMany(GroupClients::class,'id','group_id');
    }
}
