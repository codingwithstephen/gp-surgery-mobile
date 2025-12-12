<?php

namespace Tests\Feature\Api;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientApiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_list_patients(): void
    {
        Patient::factory()->count(3)->create();

        $response = $this->actingAs($this->user)->getJson('/api/patients');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'first_name',
                        'last_name',
                        'email',
                        'phone',
                        'date_of_birth',
                        'gender',
                        'nhs_number',
                    ],
                ],
            ]);
    }

    public function test_can_create_patient(): void
    {
        $patientData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '07700 900123',
            'date_of_birth' => '1985-05-15',
            'gender' => 'male',
            'address' => '123 High Street',
            'nhs_number' => '4505577104',
        ];

        $response = $this->actingAs($this->user)->postJson('/api/patients', $patientData);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
            ]);

        $this->assertDatabaseHas('patients', ['email' => 'john.doe@example.com']);
    }

    public function test_can_show_patient(): void
    {
        $patient = Patient::factory()->create();

        $response = $this->actingAs($this->user)->getJson("/api/patients/{$patient->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $patient->id,
                'email' => $patient->email,
            ]);
    }

    public function test_can_update_patient(): void
    {
        $patient = Patient::factory()->create();
        $updateData = ['first_name' => 'Updated Name'];

        $response = $this->actingAs($this->user)->putJson("/api/patients/{$patient->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson(['first_name' => 'Updated Name']);

        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'first_name' => 'Updated Name']);
    }

    public function test_can_delete_patient(): void
    {
        $patient = Patient::factory()->create();

        $response = $this->actingAs($this->user)->deleteJson("/api/patients/{$patient->id}");

        $response->assertStatus(204);
        $this->assertSoftDeleted('patients', ['id' => $patient->id]);
    }

    public function test_cannot_access_without_authentication(): void
    {
        $response = $this->getJson('/api/patients');

        $response->assertStatus(401);
    }
}
