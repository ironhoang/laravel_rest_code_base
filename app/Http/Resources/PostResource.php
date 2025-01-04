<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$post = [
			'id' => $this->id,
			'title' => $this->title,
			'content' => $this->content,
			'file' => null,
			'category' => new CategoryResource($this->category),
			'created_at' => $this->created_at->format('d M Y h:i A'),
			'updated_at' => $this->updated_at->format('d M Y h:i A'),
		];
		if (!empty($this->image)) {
			$post['file'] = new FileResource($this->image);
		}
		
		return $post;
	}
}
