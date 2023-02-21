<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientLanguage extends Model
{
    use HasFactory;

    protected $table = 'client_languages';

    public function language()
    {
        return $this->hasMany(Language::class, 'id', 'language_id');
    }
}
