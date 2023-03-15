<?php

declare(strict_types=1);

namespace Database\Factories;

use Spatie\Permission\Models\Role;
use App\Models\{Meal, Service, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Concurrent>
 */
class ConcurrentFactory extends Factory
{
	/**
	 * Define the concurrent's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$start = now()->addDays(rand(1, 60))->toImmutable();
		$model_type = fake()->randomElement([
			Meal::class,
			Service::class,
		]);
		$frequency = fake()->randomElement(['daily', 'weekly']);

		if ($frequency === 'daily') {
			$frequency_params = [
				'time' => fake()->time(format: 'H:i'),
				'window' => rand(min: 10, max: 60), // Max should be midnight - time / 2
			];
		} else { // Weekly recurring frequency
			$days_indexes = fake()->randomElements(range(1, 7), rand(1, 7));
			$frequency_params = [];

			foreach ($days_indexes as $day_index) {
				$day = now()->addDays($day_index)->format('l');

				$frequency_params[$day] = [
					'time' => fake()->time(format: 'H:i'),
				];

				$notif_recipients_types = fake()->randomElements(
					['users', 'roles'], rand(1, 2) // Can be either or both
				);

				$notification_recipients = [
					'roles' => Role::select('id')->inRandomOrder()
						->limit(rand(1, 10))->pluck('id')->toArray(),
					'users' => User::select('id')->inRandomOrder()
						->limit(rand(1, 10))->pluck('id')->toArray(),
				];

				foreach ($notif_recipients_types as $type) {
					$frequency_params[$day][$type] = $notification_recipients[$type];
				}
			}
		}
		// if daily, the next keys in the extra column should be time then window
		// time is self-explanatory
		// window should be an unsigned integer in minutes
		// So if model_type is meal and time is 20:00 (dinner for ex)
		// The window being 30 minutes
		// means that the dinner is available from 19:30 to 20:30
		// -------------------------------------------------------
		// if weekly, the next keys in the extra column should be every day from Sat to Fri => assoc time for each
		// For each day as well we have an assoc array of roles and/or users to be notified (but must select at least one role or one user)
		$extra = ['frequency' => $frequency];
		return [
			'starting_at' => $start,
			'ending_at' => $start->addDays(rand(1, 60)),
			'model_type' => $model_type,
			'model_id' => (new $model_type)->inRandomOrder()->select('id')
				->limit(1)->value('id'),
			'extra' => json_encode(array_merge($extra, $frequency_params)),
		];
	}
}
