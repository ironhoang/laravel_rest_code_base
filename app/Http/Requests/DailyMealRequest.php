<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseFormatTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class DailyMealRequest extends FormRequest
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
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		$rules = [
			'date' => 'required|date|date_format:Y-m-d',
			'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
			'foods' => 'required|string',
			'notes' => 'required|string',
			'user_id' => 'required'
		];
		
		return $rules;
	}
	
	/**
	 * Get custom error messages for validation rules.
	 *
	 * @return array
	 */
	public function messages(): array
	{
		return [
			'date.required' => 'The date field is required.',
			'date.date' => 'The date field must be a format.',
		];
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
