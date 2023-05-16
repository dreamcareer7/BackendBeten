<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use App\Models\Profession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        return response()->json(
            data: Profession::paginate(15)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProfessionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProfessionRequest $request)
    {
        Profession::create($request->validated());

        return response()->json(data: [
            'message' => __('Profession created successfully!'),
        ], status: 201); // Created
    }

    /**
     * Display the specified resource.
     *
     * @param  Profession  $profession
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Profession $profession)
    {
        return response()->json(data: $profession);
    }

    /**
     * Get the data for the form for editing a resource.
     *
     * @param \App\Models\Profession $profession
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Profession $profession): JsonResponse
    {
        return response()->json(data: [
            'profession' => $profession
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProfessionRequest  $request
     * @param  Profession  $profession
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Profession $profession, UpdateProfessionRequest $request)
    {
        $profession->update($request->validated());

        return response()->json(status: 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Profession  $profession
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();

        return response()->json(status: 204);
    }
}
