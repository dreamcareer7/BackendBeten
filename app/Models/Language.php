<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    public function user_language()
    {
        return $this->belongsTo(UserLanguage::class, 'id', 'language_id');
    }

    public function client_language()
    {
        return $this->belongsTo(ClientLanguage::class, 'id', 'language_id');
    }
}
