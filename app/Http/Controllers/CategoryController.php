<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CrudController;

class CategoryController extends CrudController
{
	protected $model = Category::class;
	protected $resource = CategoryResource::class;
	protected $requestClass = CategoryRequest::class;
}
