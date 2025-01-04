<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyExerciseResource extends JsonResource
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
			'exercise_name' => $this->exercise_name,
			'target' => $this->target,
			'unit' => $this->unit,
			'is_completed' => $this->is_completed,
			'completed_time' => $this->completed_time,
			'notes' => $this->notes,
			'kcal' => 0,
			'created_at' => $this->created_at->format('d M Y h:i A'),
			'updated_at' => $this->updated_at->format('d M Y h:i A'),
		];
	}
}
