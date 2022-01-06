<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Empleado;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmpleadoControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->empleado = Empleado::factory()->create();
    }

    /** @test */
    public function can_list_all_the_empleados()
    {
        $response = $this->actingAs($this->user)->get('/empleados');

        $response->assertStatus(200);
    }

    /** @test */
    public function can_search_for_an_empleado()
    {
        $response = $this->actingAs($this->user)->get('/empleados?=' . $this->empleado->nombre);

        $response->assertStatus(200);
    }

    /** @test */
    public function can_search_for_a_departamento()
    {
        $response = $this->actingAs($this->user)->get('/empleados?=' . $this->empleado->departamento);

        $response->assertStatus(200);
    }

    /** @test */
    public function can_create_an_empleado()
    {
        $this->actingAs($this->user)->post('api/empleados', $this->empleado->toArray());

        $this->assertDatabaseHas(
            'empleados',
            [
                'id' => $this->empleado->id
            ]
        );
    }
}
