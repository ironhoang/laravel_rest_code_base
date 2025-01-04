<?php

namespace Feature;

use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
	
	/**
	 * A basic test example.
	 */
	public function test_demo_response(): void
	{
		$this->assertTrue(true);
	}
	
	public function test_get_profile_success(): void
	{
		$token = $this->getAuthToken($this->userCredential);
		$response = $this->get('/api/v1/profile', ['Authorization' => 'bearer ' . $token]);
		$data = $response->json();
		$response->assertStatus(200);
		static::assertEquals($data['email'], $this->userCredential['email']);
	}
	
	public function test_update_profile_success(): void
	{
		$token = $this->getAuthToken($this->userCredential);
		$dataInput = [
			'name' => 'name update',
			'gender' => User::TYPE_GENDER_MALE,
			'weight' => 80,
			'height' => 170
		];
		$response = $this->put('/api/v1/profile',
			$dataInput,
			['Authorization' => 'bearer ' . $token],
		);
		$data = $response->json();
		$response->assertStatus(200);
	}
}
