<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pais;
use App\Models\User;
use App\Models\Provincia;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProvinciaControllerTest extends TestCase
{

    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->pais = Pais::factory()->create();

        $this->provincia = Provincia::factory()->create();
    }

    /** @test */
    public function can_see_provincias_index_page()
    {

        $response = $this->actingAs($this->user)->get('provincias');

        $response->assertStatus(200);

        $response->assertSee('Provincias');
    }

    /** @test */
    public function can_search_for_a_provincia()
    {

        $response = $this->actingAs($this->user)->get('provincias?search=' . $this->provincia->nombre);

        $response->assertStatus(200);

        $response->assertSee($this->provincia->nombre);
    }

    /** @test */
    public function can_see_provincias_create_page()
    {

        $response = $this->actingAs($this->user)->get(route('provincias.create'));

        $response->assertStatus(200);

        $response->assertSee('Crear Provincia');
    }

    /** @test */
    public function can_see_edit_provincia_page()
    {

        $response = $this->actingAs($this->user)->get("/provincias/{$this->provincia->id}/edit");

        $response->assertStatus(200);

        $response->assertSee('Editar Provincia');
    }


    /** @test */
    public function can_add_a_province()
    {

        $this->post('provincias', $this->provincia->toArray());

        $this->assertDatabaseHas('provincias', [
            'pais_id' => $this->provincia->pais_id,
            'nombre' => $this->provincia->nombre
        ]);
    }

    /** @test */
    public function fields_required()
    {
        $provincia = [];

        $response = $this->post('provincias', $provincia);

        $response->assertSessionHasErrors(['pais_id', 'nombre']);
    }

    /** @test */
    public function error_404_if_province_to_update_not_found()
    {
        $response = $this->put('provincias/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_update_a_province()
    {
        $provincia = Provincia::factory()->create([
            'nombre' =>  'Rio Negro'
        ]);

        $this->put('provincias/' . $provincia->id, $provincia->toArray());

        $this->assertDatabaseHas(
            'provincias',
            [
                'pais_id' => $provincia->pais_id,
                'nombre' => 'Rio Negro'
            ]
        );
    }

    /** @test */
    public function error_404_if_province_to_delete_not_found()
    {
        $response = $this->delete('provincias/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_a_province()
    {
        $this->delete('provincias/' . $this->provincia->id);

        $this->assertDatabaseMissing('provincias', $this->provincia->toArray());
    }
}
