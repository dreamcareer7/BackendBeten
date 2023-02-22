<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $table = 'crews';

    protected $fillable = [
        'fullname',
        'gender',
        'profession_id',
        'phone',
        'country_id',
        'id_type',
        'id_no',
        'dob',
        'is_active',
    ];

    /*
     * Scopes
     */

    public function scopeCountryName($query)
    {
        return $query->addSelect(['country_name' => Country::select('name')
                     ->whereColumn('country_id', 'countries.id')
                     ->limit(1)
        ]);
    }

    /*
     * Relationships
     */

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
