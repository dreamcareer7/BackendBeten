<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'fullname',
        'country_id',
        'id_type',
        'id_no',
        'gender',
        'is_handicap',
        'phone',
        'dob'
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
