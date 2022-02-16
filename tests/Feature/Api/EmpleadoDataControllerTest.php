<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmpleadoDataControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_get_all_countries()
    {
        $response = $this->actingAs($this->user)->get('/empleados/paises');

        $response->assertStatus(200);
    }
}
