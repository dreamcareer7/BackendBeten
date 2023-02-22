<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'title',
        'country_id',
        'before_date',
        'exact_date',
        'after_date'
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
