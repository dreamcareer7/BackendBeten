<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ServiceCenter;

use Illuminate\Http\{JsonResponse, Request};

class ServiceCenterController extends Controller
{
	public function index(Request $request): JsonResponse
	{
		$query = ServiceCenter::query();

		return response()->json(
			data: $query->paginate($request->per_page ?? 15)
		);
	}
}