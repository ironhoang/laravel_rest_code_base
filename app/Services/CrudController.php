<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Traits\ApiResponseFormatTrait;
use App\Traits\Ownerable;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
	use ApiResponseFormatTrait, Ownerable;
	
	protected $model;
	protected $resource;
	protected $requestClass;
	
	public function index(Request $request)
	{
		try {
			$items = $this->model::filterRecords($request);
			return $this->resource::collection($items)->additional($this->preparedResponse('index'));
		} catch (Exception $e) {
			$this->recordException($e);
			return $this->serverErrorResponse($e);
		}
	}
	
	public function store()
	{
		try {
			$request = app($this->requestClass);
			
			$request->validate([
				'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
			]);
			$imageData = [];
			if ($request->hasFile('image')) {
				$file = $request->file('image');
				
				$fileName = uniqid() . '.' . $file->getClientOriginalExtension();
				
				$path = $file->storeAs('arent', $fileName, 's3');
				$originalName = $file->getClientOriginalName();
				$size = $file->getSize();
				$mediaType = $file->getMimeType();
				
				$url = Storage::disk('s3')->url($path);
				$imageData = [
					'url' => $url,
					'title' => $originalName,
					's3_extension' => $file->getClientOriginalExtension(),
					'file_size' => $size,
					'media_type' => $mediaType,
					'file_category_type' => 'image',
					's3_key' => $path,
					's3_bucket' => config('filesystems.disks.s3.bucket'),
					's3_region' => config('filesystems.disks.s3.region'),
					'entity_type' => '',
					'entity_id' => 0,
					'is_local' => false,
				];
			}
			$inputData = $request->only(array_keys($request->rules()));
			
			if (count($imageData) > 0) {
				$file = File::create($imageData);
				$inputData['file_id'] = $file->id;
			}
			
			$item = $this->model::create($inputData);
			return (new $this->resource($item))->additional($this->preparedResponse('store'));
		} catch (QueryException $queryException) {
			return $this->queryExceptionResponse($queryException);
		}
	}
	
	public function show($id)
	{
		try {
			$item = $this->model::findOrFail($id);
			
			if (isset($this->model::$isEnableResourceOwnerCheck) && $this->model::$isEnableResourceOwnerCheck === true) {
				if (!$this->isOwner($item)) {
					return $this->forbiddenAccessResponse();
				}
			}
			
			return (new $this->resource($item))->additional($this->preparedResponse('show'));
		} catch (ModelNotFoundException $modelException) {
			return $this->recordNotFoundResponse($modelException);
		} catch (Exception $e) {
			return $this->serverErrorResponse($e);
		}
	}
	
	public function update($id)
	{
		try {
			$request = app($this->requestClass);
			$item = $this->model::findOrFail($id);
			
			if (isset($this->model::$isEnableResourceOwnerCheck) && $this->model::$isEnableResourceOwnerCheck === true) {
				if (!$this->isOwner($item)) {
					return $this->forbiddenAccessResponse();
				}
			}
			
			$item->update($request->all());
			return (new $this->resource($item))->additional($this->preparedResponse('update'));
		} catch (ModelNotFoundException $modelException) {
			return $this->recordNotFoundResponse($modelException);
		} catch (QueryException $queryException) {
			return $this->queryExceptionResponse($queryException);
		}
	}
	
	public function destroy($id)
	{
		try {
			$item = $this->model::findOrFail($id);
			
			if (isset($this->model::$isEnableResourceOwnerCheck) && $this->model::$isEnableResourceOwnerCheck === true) {
				if (!$this->isOwner($item)) {
					return $this->forbiddenAccessResponse();
				}
			}
			
			$item->status = 'inactive';
			$item->save();
			return (new $this->resource($item))->additional($this->preparedResponse('destroy'));
		} catch (ModelNotFoundException $modelException) {
			return $this->recordNotFoundResponse($modelException);
		} catch (QueryException $queryException) {
			return $this->queryExceptionResponse($queryException);
		}
	}
}
