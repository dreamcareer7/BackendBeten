<?php

namespace App\Models;

use App\Models\Traits\HasServiceCenter;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasServiceCenter;
}
