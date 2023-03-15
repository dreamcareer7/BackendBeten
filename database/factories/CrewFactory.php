<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crew>
 */
class CrewFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'fullname' => fake(locale: 'ar_SA')->name(),
			'country_id' => 1,
			'phone' => fake()->phoneNumber,
			'id_type' => 'Passport',
			'id_number' => fake()->iban,
			'dob' => fake()->date,
		];
	}
}
