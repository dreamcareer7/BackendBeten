<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
// to apply hasServiceCenter to sanctum personal API token
use App\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(): void
	{
		Model::unguard();
		Paginator::useBootstrap();
        // to apply hasServiceCenter to Sanctum personal API token
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
	}
}
