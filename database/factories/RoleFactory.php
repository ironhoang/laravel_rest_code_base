<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class RoleFactory extends Factory
{
	/**
	 * The current password being used by the factory.
	 */
	protected static ?string $password;
	
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'name' => fake()->name(),
			'status' => Role::TYPE_STATUS,
			'slug' => Role::TYPE_ROLE_ADMIN,
		];
	}
	
	/**
	 * Indicate that the model's email address should be unverified.
	 */
	public function unverified(): static
	{
		return $this->state(fn(array $attributes) => [
			'email_verified_at' => null,
		]);
	}
}
