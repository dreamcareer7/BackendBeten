<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\NewDocumentRequest;
use App\Models\Crew;
use App\Models\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpParser\Comment\Doc;
use App\Http\Controllers\Controller;


class DocumentAPIController extends Controller
{
    public function __construct()
    {
        $this->authUser = auth('api')->user();
        $this->userId = @$this->authUser->id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($this->authUser->hasPermissionTo('documents.index')) {

            $doc = Document::paginate($request->input('per_page')?? 25);

            return response()->json( ([
                'message'       => 'Documents list',
                'data'          =>  $doc,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to see Documents', 402);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */

    public function store(Request $request)
    {
        if ($this->authUser->hasPermissionTo('documents.create')) {

            Validator::make(
                $request->all(),
                $this->validationRules()
            )->validate();

           $doc= Document::create([
                'fullname'=> $request->post('fullname'),
                'gender'=> $request->post('gender'),
                'country_id'=> $request->post('country'),
                'phone'=> $request->post('phone'),
                'id_type'=> $request->post('id_type'),
                'id_no'=> $request->post('id_no'),
                'is_handicap'=> $request->post('is_handicap'),
                'dob'=> $request->post('dob'),
            ]);
            return response()->json( ([
                'message'       => 'Documents Create Successfully',
                'data'          =>  $doc,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to add Documents', 402);
        }

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->authUser->hasPermissionTo('documents.view')) {
            $doc = Document::find($id);
            return response()->json( ([
                'message'       => 'Document Details',
                'data'          =>  $doc,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to see Document', 402);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $document
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if ($this->authUser->hasPermissionTo('documents.delete')) {
            $doc = Document::delete($id);

            return response()->json( ([
                'message'       => 'Document Deleted Successfully',
                'data'          =>  null,
                'status_code'   => 200,
            ]));
        } else {
            return  response()->json('dont have permission to delete Document', 402);
        }
    }


    private function validationRules()
    {
		$result = [
			'fullname' => 'required|string|min:4',
			'gender' => 'required',
			'id_type' => 'required',
			'id_number' => 'required',
		];

		return $result;
    }

    public function uploadFile(NewDocumentRequest $request){

        $success =false;
        $message = "";
        $file = $request->file('file') ?? null;
        $file_name = $file->getBasename();
        $file_extension= $file->getExtension();
        $fname = $file->getFilename();
         $message = $file_name;
        $random = Str::random(15);

        $qualified_name = $file_name.'_'.$random.".".$file_extension;
        $uploadLocation = resource_path('documents'.DIRECTORY_SEPARATOR.$qualified_name);

         $uploaded =  Storage::putFile($uploadLocation,$file);

        return response()->json([
           "success"=>$success,
           "message"=>$message
        ]);
    }
}
