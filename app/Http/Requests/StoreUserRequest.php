<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseFormatTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class StoreUserRequest extends FormRequest
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
		return [
			'name' => 'required|max:100',
			'email' => 'required|email|max:100',
			'password' => 'required|max:30',
			'role' => 'required|in:admin,user',
		];
	}
	
	
	/**
	 * Get custom error messages for validation rules.
	 *
	 * @return array
	 */
	public function messages(): array
	{
		return [
			'name.required' => 'The name field is required.',
			'name.max' => 'The name field may not be greater than 100 characters.',
			'email.required' => 'The email address field is required.',
			'email.email' => 'The email address must be a valid email address',
			'email.max' => 'The email address field may not be greater than 100 characters.',
			'password.required' => 'The password field is required.',
			'password.max' => 'The password field may not be greater than 30 characters.',
		];
	}
	
	
	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json($this->validationFailedResponse($validator->errors()), Response::HTTP_UNPROCESSABLE_ENTITY));
	}
}
