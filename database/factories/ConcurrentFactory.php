<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concurrent>
 */
class ConcurrentFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$start = now()->addMonth()->toImmutable();
		$model_type = fake()->randomElement([
			'App\Models\City',
			'App\Models\Crew',
			'App\Models\Hospitality',
			'App\Models\Phase',
			'App\Models\Client',
			// 'App\Models\Document',
			// 'App\Models\Invoice',
			// 'App\Models\Profession',
			'App\Models\User',
			'App\Models\Dormitory',
			'App\Models\Service',
			// 'App\Models\Complaint',
			// 'App\Models\Evaluation',
			'App\Models\Contract',
			'App\Models\Meal',
			'App\Models\Group',
			'App\Models\MealType',
			'App\Models\Vehicle',
		]);
		return [
			'starting_at' => $start,
			'ending_at' => $start->addMonths(2),
			'model_type' => $model_type,
			'model_id' => (new $model_type)->inRandomOrder()->select('id')
				->limit(1)->value('id'),
			'repeated_every' => fake()->randomElement([
				'hours',
				'day',
				'week',
			]),
			'extra' => json_encode([fake()->name => fake()->name]),
		];
	}
}
