<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLanguage extends Model
{
    use HasFactory;

    protected $table = 'client_languages';

    protected $fillable = [
        'client_id',
        'language_id',
    ];
    public function language()
    {
        return $this->hasMany(Language::class, 'id', 'language_id');
    }
}
