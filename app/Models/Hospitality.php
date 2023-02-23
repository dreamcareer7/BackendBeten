<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hospitality extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'required_date' => 'datetime',
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @return string the date formatted
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }

    /**
     * Get the crew member receiving the hospitality
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function receiver(): BelongsTo
     {
        return $this->belongsTo(Crew::class, 'received_by');
     }
}
