<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Models\Evaluation;

class EvaluationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            data: Evaluation::paginate(15)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateEvaluationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEvaluationRequest $request)
    {
        $data = $request->validated();

        $data['voter_model_type'] = 'App\Models\User';
        $data['voter_model_id'] = auth()->user()->id;

        Evaluation::create($data);

        return response()->json(data: [
            'message' => __('Evaluation created successfully!'),
        ], status: 201); // Created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Evaluation::find($id);

        return response()->json(data: $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        return response()->json(data: [
            'evaluation' => $evaluation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEvaluationRequest  $request
     * @param  Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        $evaluation->update([
            'vote' => $request->vote,
            'note' => $request->note ?? '',
            'provider_model_type' => $request->provider_model_type,
            'provider_model_id' => $request->provider_model_id
        ]);
        return response()->json(status: 204); // No content
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return response()->json(status: 204); // No content
    }
}
