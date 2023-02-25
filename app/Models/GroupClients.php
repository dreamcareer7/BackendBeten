<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\GroupClients
 *
 * @property int $id
 * @property int $client_id
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupClients whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
