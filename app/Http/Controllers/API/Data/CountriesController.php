<?php

namespace App\Http\Controllers\API\Data;

use App\Http\Controllers\Controller;
use App\Models\Country;

class CountriesController extends Controller
{
    public function index()
    {
        return Country::select(['id', 'name', 'code'])->get();
    }
}
