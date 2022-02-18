<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Pais;
use App\Models\User;
use App\Models\Provincia;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmpleadoDataControllerTest extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_can_get_all_paises()
    {
        $response = $this->actingAs($this->user)->json('GET', 'api/empleados/paises');

        $response->assertStatus(200);
    }

    public function test_can_get_all_provincias()
    {

        $pais = Pais::factory()->create();

        $response = $this->actingAs($this->user)->json('GET', "api/empleados/{$pais->id}/provincias");

        $response->assertStatus(200);
    }

    public function test_can_get_all_departamentos()
    {
        $response = $this->actingAs($this->user)->json('GET', 'api/empleados/departamentos');

        $response->assertStatus(200);
    }

    public function test_can_get_all_ciudades()
    {

        $provincia = Provincia::factory()->create();

        $response = $this->actingAs($this->user)->json('GET', "api/empleados/{$provincia->id}/ciudades");

        $response->assertStatus(200);
    }
}
