<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ciudad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CiudadControllerTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->ciudad = Ciudad::factory()->create();
    }

    /** @test */
    public function can_see_a_ciudades_index()
    {
        $response = $this->actingAs($this->user)->get('ciudades');

        $response->assertStatus(200);

        $response->assertSee('Ciudades');
    }

    /** @test */
    public function can_search_for_a_ciudad()
    {
        $response = $this->actingAs($this->user)->get('ciudades?search=' . $this->ciudad->nombre);

        $response->assertStatus(200);

        $response->assertSee($this->ciudad->nombre);
    }

    /** @test */
    public function can_see_ciudad_create_page()
    {
        $response = $this->actingAs($this->user)->get(route('ciudades.create'));

        $response->assertStatus(200);

        $response->assertSee('Crear Ciudad');
    }

    /** @test */
    public function can_see_ciudad_edit_page()
    {
        $response = $this->actingAs($this->user)->get("ciudades/{$this->ciudad->id}/edit");

        $response->assertStatus(200);

        $response->assertSee('Editar Ciudad');
    }

    /** @test */
    public function can_add_a_ciudad()
    {
        $this->post('ciudades', $this->ciudad->toArray());

        $this->assertDatabaseHas('ciudades', [
            'provincia_id' => $this->ciudad->provincia_id,
            'nombre' => $this->ciudad->nombre,
        ]);
    }

    /** @test */
    public function fields_required()
    {
        $ciudad = [];

        $response = $this->post('ciudades', $ciudad);

        $response->assertSessionHasErrors(['provincia_id', 'nombre']);
    }

    /** @test */
    public function error_404_if_ciudad_to_update_not_found()
    {
        $response = $this->put('ciudades/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_update_a_province()
    {
        $ciudad = Ciudad::factory()->create([
            'nombre' => 'Viedma'
        ]);

        $this->put("ciudades/{$ciudad->id}", $ciudad->toArray());

        $this->assertDatabaseHas(
            'ciudades',
            [
                'provincia_id' => $ciudad->provincia_id,
                'nombre' => 'Viedma'
            ]
        );
    }

    /** @test */
    public function error_404_if_ciudad_to_delete_not_found()
    {
        $response = $this->delete('ciudades/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_a_province()
    {
        $this->delete("ciudades/{$this->ciudad->id}");

        $this->assertDatabaseMissing('ciudades', $this->ciudad->toArray());
    }
}
