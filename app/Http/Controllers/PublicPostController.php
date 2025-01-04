<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponseFormatTrait;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class PublicPostController extends Controller
{
	use ApiResponseFormatTrait;
	
	/**
	 * Display a listing of the resource.
	 */
	public function index(FormRequest $request)
	{
		try {
			$items = Post::filterRecords($request);
			return PostResource::collection($items)->additional($this->preparedResponse('index'));
		} catch (Exception $e) {
			$this->recordException($e);
			return $this->serverErrorResponse($e);
		}
	}
	
}
