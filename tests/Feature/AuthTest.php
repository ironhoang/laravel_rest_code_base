<?php

declare(strict_types=1);

namespace Feature;

use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class AuthTest extends TestCase
{
	
	public function testTheAuthLoginApiReturnsASuccessfulResponse(): void
	{
		$response = $this->json('POST', '/api/auth/login', [
			'email' => $this->userCredential['email'],
			'password' => $this->userCredential['password'],
		]);
		$response->assertStatus(200);
	}
}
