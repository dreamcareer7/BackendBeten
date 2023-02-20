<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupClients extends Model
{
    use HasFactory;
    protected $table='group_clients';
    protected $fillable=[
      "group_id",
      "client_id"
    ];

    public function client(){
        return $this->hasOne(Client::class,'id','client_id');
    }
}
