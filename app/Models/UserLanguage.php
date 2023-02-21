<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    use HasFactory;

    protected $table = 'user_languages';

    protected $fillable = [
        'user_id',
        'language_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
    public function language()
    {
        return $this->hasMany(Language::class, 'id', 'language_id');
    }
}
