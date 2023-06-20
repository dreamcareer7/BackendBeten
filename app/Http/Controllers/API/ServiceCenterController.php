<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateServiceCenterRequest;
use App\Http\Requests\UpdateServiceCenterRequest;
use App\Models\ServiceCenter;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{JsonResponse, Request};

class ServiceCenterController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = ServiceCenter::query()->with('user');

        return response()->json(
            data: $query->paginate($request->per_page ?? 15)
        );
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ServiceCenter $serviceCenter): JsonResponse
    {
        return response()->json([
            'data' => $serviceCenter
        ]);
    }

    /**
     * Get the data for the form for creating a new service center.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): JsonResponse
    {
        /* return response()->json([
             'users' => User::select('id', 'name')->get(),
             'services' => Service::select('id', 'title')->get(),
         ]);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateServiceCenterRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateServiceCenterRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();


            $inputData = $request->only([
                'title',
                'phone',
                'location',
                'group',
                'maxClientCount'
            ]);

            $user_inputData = $request->only([
                'name',
                'email',
                'contact'
            ]);

            $service_center = ServiceCenter::create($inputData);



            $user_inputData['service_center_id'] = $service_center['id'];
            $user_inputData['password'] = bcrypt("123456");
            $user_inputData['is_active'] = 1;


            User::create($user_inputData)
                ->assignRole(config('eogsoft.special_role.service_center_admin_role'));


            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return response()->json(data: [
            'message' => __('Service center created successfully!'),
        ], status: 201); // Created
    }

    /**
     * Get the data for the form for editing a service center.
     *
     * @param \App\Models\ServiceCenter $commit
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(ServiceCenter $serviceCenter): JsonResponse
    {
        return response()->json(data: [
            'commit' => $serviceCenter,
            'users' => User::select('id', 'name')->get(),
            'services' => Service::select('id', 'title')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateServiceCenterRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateServiceCenterRequest $request, int $id): JsonResponse
    {
        $inputData = $request->only([
            'title',
            'phone',
            'location',
            'group',
            'maxClientCount'
        ]);

        ServiceCenter::whereId($id)->update($inputData);

        return response()->json(status: 204); // No content
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $serviceCenter = ServiceCenter::find($id)->delete($id);

        if($serviceCenter){
            (new ServiceCenter())->deleteUserByServiceCenterId($id);
        }

        return response()->json(([
            'message'       => 'Services center Deleted Successfully',
            'data'          =>  [],
            'status_code'   => 200,
        ]));
    }
}
