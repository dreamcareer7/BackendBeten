<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => 'welcome to our page');

//Route::get('servicecenters', [ServiceCenterController::class, 'index']);


