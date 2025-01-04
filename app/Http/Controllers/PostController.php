<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\CrudController;

class PostController extends CrudController
{
	protected $model = Post::class;
	protected $resource = PostResource::class;
	protected $requestClass = PostRequest::class;
}
