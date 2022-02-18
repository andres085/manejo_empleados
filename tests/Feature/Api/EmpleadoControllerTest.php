<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Departamento;
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
        $response = $this->actingAs($this->user)->json('GET', 'api/empleados');

        $response->assertStatus(200);
    }

    /** @test */
    public function can_search_for_an_empleado_by_nombre()
    {
        $nombre = $this->empleado->nombre;

        $response = $this->actingAs($this->user)->json('GET', 'api/empleados?=', ['search' => $nombre]);

        $response->assertStatus(200)->assertJsonFragment(['nombre' => $nombre]);
    }

    /** @test */
    public function can_search_for_an_empleado_by_departamento()
    {
        $id_departamento = Departamento::factory()->create()->id;

        $response = $this->actingAs($this->user)->json('GET', 'api/empleados?=', ['id_departamento' => $id_departamento]);

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

    /** @test */
    public function can_update_an_empleado()
    {
        $empleado = Empleado::factory()->create([
            'apellido' => 'Martinez'
        ]);

        $response = $this->actingAs($this->user)->json('PUT', "api/empleados/{$empleado->id}", $empleado->toArray());

        $response->assertStatus(200);
    }

    /** @test */
    public function error_404_if_empleado_to_update_not_exists()
    {
        $response = $this->actingAs($this->user)->json('PUT', "api/empleados/-1", []);

        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_an_empleado()
    {
        $response = $this->actingAs($this->user)->json('DELETE', "api/empleados/{$this->empleado->id}");

        $response->assertStatus(200)->assertSee('Empleado borrado con exito');
    }

    /** @test */
    public function error_404_if_empleado_to_delete_not_exists()
    {

        $response = $this->actingAs($this->user)->json('DELETE', "api/empleados/-1");

        $response->assertStatus(404);
    }
}
