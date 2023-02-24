<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\Traits\HasContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Crew extends Model
{
    use HasFactory, HasContract;

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

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
