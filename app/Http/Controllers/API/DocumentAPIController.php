<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\NewDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
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
        if (auth()->user()->hasPermissionTo('documents.index')) {

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

    public function info($id){
        $document  = Document::findorfail($id);

        return response()->json($document);
    }

    public function getFile($path){
        $uploadLocation = resource_path('documents/');
        $actual_location = $uploadLocation.$path;
        $file  = File::get($actual_location);

        Storage::disk('local')->download($actual_location);
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
        Document::findorfail($id);
        Document::where('id',$id)->delete();
         return response()->json( ([
            'message'       => 'Document Deleted Successfully',
            'success'          =>  true,
        ]));

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
        $random = Str::random(10);
        $uploadLocation = public_path('documents');
        $actual_location = $uploadLocation.$random.'_'.$file->getClientOriginalName();
        $uploaded= $file->move($uploadLocation,$random.'_'.$file->getClientOriginalName());
        $message =$uploaded;

        if($uploaded){
            Document::create([
                "title"=>$request->input('title'),
                "model_type"=>$request->input('model_type'),
                "model_id"=>$request->input('model_id'),
                "path"=>$random.'_'.$file->getClientOriginalName()
              //  "uploaded_by"=>Auth::guard('api')->id(),
            ]);
            $success = true;
            $message = "Document Uploaded successfully.";
        }
        else{
            $message = "There was an error while uploading file.";
        }

        return response()->json([
            "success"=>$success,
            "message"=>$message
        ]);
    }
    public function updateDocument($id,UpdateDocumentRequest $request){

        $success =false;
        $message = "";

        $data = $request->only([
            "title",
            "model_type",
            "model_id",
        ]);


        $file = $request->file('file') ?? null;
        if($file){
            $random = Str::random(10);
            $uploadLocation = public_path('documents');
            $actual_location = $uploadLocation.$random.'_'.$file->getClientOriginalName();
            $uploaded= $file->move($uploadLocation,$random.'_'.$file->getClientOriginalName());
            $message =$uploaded;
            if($uploaded){
                $success = true;
                $message = "Document Uploaded successfully.";
            }
            else{
                $message = "There was an error while uploading file.";
            }
            $data["path"]=$random.'_'.$file->getClientOriginalName();
        }
        else{
            $success = true;
        }
        if($success){
            Document::where('id',$id)->update($data);
            $message = "Document Updated Successfully.";
        }
        return response()->json([
            "success"=>$success,
            "message"=>$message
        ]);
    }

    public function paginate(Request $request){
        $documents = Document::orderby('id','desc');
        $title= $request->input('title') ?? null;
        $model_type= $request->input('model_type') ?? null;
        $model_id= $request->input('model_id') ?? null;


        $per_page= $request->input('per_page') ?? 25;
        if($title){
            $documents->where('title','LIKE',$title.'%');
        }
        if($model_type){
            $documents->where('model_type',$model_type);
        }
        if($model_id){
            $documents->where('model_id',$model_id);
        }


        return response()->json($documents->paginate($per_page));
    }
}
