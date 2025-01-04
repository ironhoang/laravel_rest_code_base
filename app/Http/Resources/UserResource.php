<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
	public static $wrap = null;
	
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$item = [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'gender' => $this->gender,
			'weight' => $this->weight,
			'height' => $this->height,
			'role' => $this->role->name,
			'created_at' => $this->created_at->format('d M Y h:i A'),
			'updated_at' => $this->updated_at->format('d M Y h:i A'),
		];
		
		
		return $item;
	}
}
