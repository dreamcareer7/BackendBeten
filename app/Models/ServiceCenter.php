<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCenter extends Model
{
	use HasFactory;
	
	protected $fillable = ['title', 'phone', 'location', 'group', 'maxClientCount'];
}
