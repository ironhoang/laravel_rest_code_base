<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BodyMetricResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'date' => $this->date,
			'height' => $this->height,
			'weight' => $this->weight,
			'notes' => $this->notes,
			'bmi' => $this->bmi,
			'body_fat' => $this->body_fat,
			'created_at' => $this->created_at->format('d M Y h:i A'),
			'updated_at' => $this->updated_at->format('d M Y h:i A'),
		];
	}
}
