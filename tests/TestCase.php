<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	
	use RefreshDatabase;
	
	public $userId = 0;
	protected bool $useDatabase = true;
	protected array $userCredential = [
		'name' => 'user1',
		'email' => 'user1@unitest.com',
		'password' => 'testtest',
	];
	protected string $loginAPIPath = '/api/auth/login';
	protected array $loginCredential = [];
	
	protected function setUp(): void
	{
		parent::setUp();
		
		$role = Role::factory()->create([
			'name' => 'admin',
			'slug' => Role::TYPE_ROLE_ADMIN,
			'status' => Role::TYPE_STATUS,
		]);
		$userData = $this->userCredential;
		$userData['role_id'] = $role->id;
		$user = User::factory()->create($userData);
	}
	
	protected function getAuthToken(?array $credential = null): string
	{
		if (null === $credential) {
			$credential = $this->loginCredential;
		}
		$response = $this->postJson($this->loginAPIPath, $credential);
		$accessToken = $response->json('response')['data']['access_token'];
		$response = $this->get('/api/v1/profile', ['Authorization' => 'bearer ' . $accessToken]);
		$this->userId = $response->json('id');
		
		
		return $accessToken;
	}
	
}
