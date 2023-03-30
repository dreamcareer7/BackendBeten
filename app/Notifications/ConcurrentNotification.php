<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Concurrent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ConcurrentNotification extends Notification
{
	use Queueable;

	private $concurrent;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(Concurrent $concurrent)
	{
		$this->concurrent = $concurrent;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['database'];
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			'type' => __($this->concurrent->model_type),
		];
	}
}
