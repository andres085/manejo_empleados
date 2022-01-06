<?php

namespace Tests\Feature;

use App\Models\Departamento;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DepartamentoControllerTest extends TestCase
{

    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->departamento = Departamento::factory()->create();
    }

    /** @test */
    public function can_see_departamentos_index_page()
    {
        $response = $this->actingAs($this->user)->get('departamentos');

        $response->assertStatus(200);

        $response->assertSee('Departamentos');
    }

    /** @test */
    public function can_search_for_a_departamento()
    {
        $response = $this->actingAs($this->user)->get('departamentos?search=' . $this->departamento->nombre);

        $response->assertStatus(200);

        $response->assertSee($this->departamento->nombre);
    }

    /** @test */
    public function can_see_a_departamento_create_page()
    {
        $response = $this->actingAs($this->user)->get(route('departamentos.create'));

        $response->assertStatus(200);

        $response->assertSee('Crear Departamento');
    }

    /** @test */
    public function can_create_a_departamento()
    {
        $this->post('departamentos', $this->departamento->toArray());

        $this->assertDatabaseHas('departamentos', [
            'nombre' => $this->departamento->nombre
        ]);
    }

    /** @test */
    public function fields_required()
    {
        $departamento = [];

        $response = $this->post('departamentos', $departamento);

        $response->assertSessionHasErrors(['nombre']);
    }

    /** @test */
    public function error_404_if_departamento_to_update_not_found()
    {
        $response = $this->put('departamentos/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_see_edit_departamento_page()
    {
        $response = $this->actingAs($this->user)->get("/departamentos/{$this->departamento->id}/edit");

        $response->assertStatus(200);

        $response->assertSee('Actualizar Departamento');
    }

    /** @test */
    public function can_update_a_departamento()
    {
        $departamento = Departamento::factory()->create([
            'nombre' => 'Adolfo Alsina'
        ]);

        $this->put('departamentos/' . $departamento->id, $departamento->toArray());

        $this->assertDatabaseHas('departamentos', [
            'nombre' => 'Adolfo Alsina'
        ]);
    }

    /** @test */
    public function error_404_if_departamento_to_delete_not_found()
    {
        $response = $this->delete('departamentos/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_a_departamento()
    {
        $this->delete('departamentos/' . $this->departamento->id);

        $this->assertDatabaseMissing('departamentos', $this->departamento->toArray());
    }
}
