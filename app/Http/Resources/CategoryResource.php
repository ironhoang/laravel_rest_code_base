<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$category = [
			'id' => $this->id,
			'name' => $this->name,
			'description' => $this->description,
			'image' => '',
			'created_at' => $this->created_at->format('d M Y h:i A'),
			'updated_at' => $this->updated_at->format('d M Y h:i A'),
		];
		if (!empty($this->image)) {
			$category['file'] = new FileResource($this->image);
		}
		return $category;
	}
}
