<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Service;
use App\Models\ServiceModel;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\{CreateServiceRequest, UpdateServiceRequest};

/**
 * @group Service
 *
 * API endpoints for managing Service
 */
class ServiceAPIController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Service::class);
	}

	/**
	 * Display a listing of the services.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(): JsonResponse
	{
		$services = Service::select(
			'id',
			'title',
			'city_id',
			'before_date',
			'exact_date',
			'after_date'
		)->with('city:id,title')->paginate(15);

		return response()->json(data: $services, status: 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param \App\Models\Service $service
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function show(Service $service): JsonResponse
	{
        $serviceModels = (new ServiceModel())->getServiceModelsByServiceId($service->id);
        $models = $this->getModelAssoc();
        if(!empty($serviceModels)) {
            $service->service_models = $serviceModels;
        }

        if(!empty($models)) {
            $service->models = $models;
        }

		return response()->json(data: $service);
	}

	/**
	 * Store a newly created service.
	 * at least the user must enter one of the dates
	 *
	 * @bodyParam title string required
	 * @bodyParam city_id int required
	 * @bodyParam before_date string
	 * @bodyParam exact_date string
	 * @bodyParam after_date string
	 *
	 * @param \App\Http\Requests\CreateServiceRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CreateServiceRequest $request): JsonResponse
	{
        $model_ids = $request->model_ids;

		$service = Service::create([
			'title' => $request->title,
			'city_id' => $request->city_id,
			'before_date' => $request->before_date,
			'exact_date' => $request->exact_date,
			'after_date' => $request->after_date,
		]);

        $service_id = $service->id;

        if($service_id > 0 && !empty($model_ids)){
            (new ServiceModel())->insertServiceModels($service_id,$model_ids);
        }

		return response()->json(data: [
			'message' => __('Service created successfully!'),
		], status: 201);
	}

	/**
	 * Update the specified service.
	 *
	 * @bodyParam title string required
	 * @bodyParam city_id int required
	 * @bodyParam before_date string
	 * @bodyParam exact_date string
	 * @bodyParam after_date string
	 *
	 * @param \App\Http\Requests\UpdateServiceRequest $request
	 * @param \App\Models\Service $service
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(
		UpdateServiceRequest $request,
		Service $service
	): JsonResponse
	{
        $model_ids = $request->model_ids;

		$service->update([
			'title' => $request->title,
			'city_id' => $request->city_id,
			'before_date' => $request->before_date,
			'after_date' => $request->after_date,
			'exact_date' => $request->exact_date,
		]);

        $service_id = $service->id;

        if($service_id > 0 && !empty($model_ids)){
            (new ServiceModel())->updateServiceModels($service_id,$model_ids);
        }

		return response()->json(status: 202); // Accepted
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id)
	{
		$crew = Service::find($id)->delete($id);

        if($crew){
            (new ServiceModel())->deleteByServiceId($id);
        }

		return response()->json(([
			'message'       => 'services Deleted Successfully',
			'data'          =>  null,
			'status_code'   => 200,
		]));
	}

    public function getModels():JsonResponse
    {
        $prepare_model_data = $this->getModelAssoc();

        return response()->json(([
            'message' => 'Model fetched Successfully',
            'data' => $prepare_model_data,
            'status_code' => 200,
        ]));
    }

    private function getModelAssoc():array{
        $models = (new \App\Common\CommonLogic())->getModels();

        $prepare_model_data = [];

        foreach ($models as $m){
            $prepare_model_data[] =['name'=> $m['key'],'id'=>$m['id']];
        }

        return $prepare_model_data;
    }
}
