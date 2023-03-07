<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\Document;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Storage, Validator};
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentAPIController extends Controller
{
	public function __construct()
	{
		$this->authorizeResource(Document::class);
	}
	/**
	 * Display a listing of the documents for a given model.
	 *
	 * @param string $type the model type
	 * @param int $id the model id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(string $type, int $id): JsonResponse
	{
		$type = 'App\Models\\' . Str::title($type);
		// If the model specified is not in the document model types
		// Refuse the query
		if (! in_array($type, Document::$model_types)) {
			return response()->json(status: 400); // Bad request
		}
		$documents = Document::where([
				'model_type' => $type,
				'model_id' => $id,
			])->select(
				'id',
				'title',
				'path',
				'model_type',
				'model_id',
				'created_by',
				'created_at',
				'deleted_by',
				'deleted_at'
			)->get();
		return response()->json(DocumentResource::collection($documents));
	}

	/**
	 * Download the specified document.
	 *
	 * @param string $path Path of the document to download
	 *
	 * @return \Symfony\Component\HttpFoundation\StreamedResponse
	 */
	public function download(string $path): StreamedResponse
	{
		return Storage::download('documents/' . $path);
	}

	/**
	 * Store a newly created document in database.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param string $type Model type to upload the documents for
	 * @param int $id Model ID to upload the documents for
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(Request $request, string $type, int $id): JsonResponse
	{
		$type = 'App\Models\\' . Str::title($type);
		// TODO: Must also validate that the ID exists in that model
		// Maybe also move this whole thing to a FormRequest class
		if (
			// If the model specified is not in the document model types
			!in_array($type, Document::$model_types) ||
			// Or the request is missing documents files array
			!$request->hasFile('documents') ||
			// Or the request is missing a title for the documents
			// The same title will be applied to all the created documents btw
			$request->missing('title')
		) {
			// Reject the operation
			return response()->json(status: 400); // Bad request
		}
		// Iterate through the documents files in the request
		foreach ($request->documents as $document) {
			// We can't get the dynamic model to attach contracts for
			// But we have the class name, so we invert the operation
			// Create a new document from each of the files
			Document::create([
				'title' => $request->title,
				'path' => $document->store('documents'),
				'model_type' => $type, // Pass the model type, namespaced
				'model_id' => $id, // Pass the model ID
				'created_by' => auth()->id(),
			]);
		}
		return response()->json(status: 201); // Created
	}

	/**
	 * Remove the specified document from database.
	 *
	 * @param int $id The ID of the document to delete.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id): JsonResponse
	{
		Validator::make(['id' => $id], [
			'id' => 'bail|required|integer|exists:documents,id'
		])->validate();
		Document::where('id', $id)->delete();
		return response()->json(status: 204); // No content
	}
}
