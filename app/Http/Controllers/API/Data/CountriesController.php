<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Data;

use App\Models\Country;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{
	public function index()
	{
		return Country::select(['id', 'name', 'code'])->get();
	}
}
