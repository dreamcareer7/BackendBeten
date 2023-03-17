<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;

class ContractTest extends TestCase
{
	/**
	 * Test contract file validation
	 *
	 * @return void
	 */
	public function test_create_contract_file_validation(): void
	{
		Sanctum::actingAs(user: User::first());
		$response = $this->postJson(uri: '/api/contracts/crew/1', data: [
			'reference' => fake()->iban,
			'contracts' => [
				UploadedFile::fake()->image('not_pdf.jpg'),
			],
		]);

		$response->assertJsonValidationErrorFor(key: 'contracts.0');

		$response->assertUnprocessable();
	}
}
