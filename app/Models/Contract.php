<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Contract extends Model
{
    /** @var array $model_types Available model types for contracts */
    // Note that this property is currently for documentation purposes only
    // It's not referenced or used anywhere in the codebase
    public static array $model_types = [
        Crew::class,
        Vehicle::class,
        Dormitory::class,
    ];

    /**
     * Get the parent contractable model (any of $this->model_types)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     **/
    public function contractable(): MorphTo
    {
        return $this->morphTo();
    }
}
