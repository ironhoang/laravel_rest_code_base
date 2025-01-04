<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseFormatTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class SetExerciseTargetRequest extends FormRequest
{
	use ApiResponseFormatTrait;
	
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		$rules = [
			'date' => 'required|date',
			'exercise_name' => 'required|string',
			'target' => 'required|numeric|min:1',
			'unit' => 'required|string',
			'is_completed' => 'boolean',
			'completed_time' => 'numeric',
			'notes' => 'string',
		];
		
		return $rules;
	}
	
	/**
	 * Prepare the data for validation.
	 *
	 * @return void
	 */
	protected function prepareForValidation(): void
	{
	}
	
	/**
	 * Handle a failed validation attempt.
	 *
	 * @param \Illuminate\Contracts\Validation\Validator $validator
	 * @return void
	 *
	 * @throws Illuminate\Http\Exceptions\HttpResponseException
	 */
	
	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json($this->validationFailedResponse($validator->errors()), Response::HTTP_UNPROCESSABLE_ENTITY));
	}
}
