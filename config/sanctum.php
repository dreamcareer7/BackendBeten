<?php

declare(strict_types=1);

use Laravel\Sanctum\Sanctum;

return [

	/*
	|--------------------------------------------------------------------------
	| Sanctum Guards
	|--------------------------------------------------------------------------
	|
	| This array contains the authentication guards that will be checked when
	| Sanctum is trying to authenticate a request. If none of these guards
	| are able to authenticate the request, Sanctum will use the bearer
	| token that's present on an incoming request for authentication.
	|
	*/

	'guard' => ['api'],

	/*
	|--------------------------------------------------------------------------
	| Expiration Minutes
	|--------------------------------------------------------------------------
	|
	| This value controls the number of minutes until an issued token will be
	| considered expired. If this value is null, personal access tokens do
	| not expire. This won't tweak the lifetime of first-party sessions.
	|
	*/

	'expiration' => null,
];
