<?php

namespace Tests\Feature;

use App\Models\Spy;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SpyControllerTest extends TestCase
{

    public function test_index_returns_a_successful_response(): void
    {
        $response = $this->get('/api/v1/spies');

        $response->assertStatus(200);
    }

    public function test_new_spy_store_success(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $spy = Spy::factory()->create();

        $response = $this->withToken($token)->postJson('/api/v1/spies', [
            'name' => 'Test_' . $spy->name,
            'surname' => $spy->surname,
            'agency' => $spy->agency,
            'country_of_operation' => $spy->country_of_operation,
            'birth_date' => $spy->birth_date->format('Y-m-d'),
            'death_date' => $spy->death_date ? $spy->death_date->format('Y-m-d') : null,
        ]);

        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('message', 'Spy created successfully')
            );
    }

    public function test_new_spy_store_failure(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $spy = Spy::factory()->create();

        $response = $this->withToken($token)->postJson('/api/v1/spies', [
            'name' => 'Test_' . $spy->name,
            'surname' => $spy->surname,
            'agency' => $spy->agency,
            'country_of_operation' => $spy->country_of_operation,
            'birth_date' => $spy->birth_date,
            'death_date' => $spy->death_date,
        ]);

        $response->assertStatus(500)
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('message', 'Failed to create spy')
            );
    }

    public function test_random(): void
    {
        $response = $this->get('/api/v1/spies/random');
        $response->assertStatus(200)
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data')
                ->first(fn(AssertableJson $json) => $json
                    ->each(fn(AssertableJson $json) => $json
                        ->hasAll(['id', 'name', 'surname', 'agency', 'country_of_operation', 'birth_date', 'death_date', 'full_name'])
                    )
                )
            );
    }
}
