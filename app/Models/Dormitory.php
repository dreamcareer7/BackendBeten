<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;

    protected $table = 'dormitories';

    protected $fillable=[
        'title' ,
        'phone' ,
        'country' ,
        'city_id' ,
        'location' ,
        'coordinate' ,
        'is_active' ,
    ];


    /*
    * Scopes
    */

    public function scopeCountryName($query)
    {
        return $query->addSelect(['country_name' => Country::select('name')
            ->whereColumn('country', 'countries.id')
            ->limit(1)
        ]);
    }

    /*
     * Relationships
     */

    public function country()
    {
        return $this->belongsTo(Country::class, 'id', 'country');
    }
}
