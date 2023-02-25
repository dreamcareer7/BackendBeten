<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dormitory>
 */
class DormitoryFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'title' => fake()->name,
			'phone' => fake()->phoneNumber,
			'country' => fake()->country,
			'city_id' => 1,
			'location' => fake()->address,
			'coordinate' => 'fdjklsflksdj',
		];
	}
}
