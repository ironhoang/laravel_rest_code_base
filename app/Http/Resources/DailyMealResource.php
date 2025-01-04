<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyMealResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$item = [
			'id' => $this->id,
			'date' => $this->date,
			'meal_type' => $this->meal_type,
			'foods' => $this->foods,
			'notes' => $this->notes,
			'image' => null,
			'created_at' => $this->created_at->format('d M Y h:i A'),
			'updated_at' => $this->updated_at->format('d M Y h:i A'),
		];
		if (!empty($this->image)) {
			$item['image'] = new FileResource($this->image);
		}
		return $item;
	}
}
