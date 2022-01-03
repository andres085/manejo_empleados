<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pais;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PaisesControllerTest extends TestCase
{

    use DatabaseMigrations;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->pais = Pais::factory()->create();
    }

    /** @test */
    public function can_see_paises_index_page()
    {

        $response = $this->actingAs($this->user)->get('paises');

        $response->assertStatus(200);

        $response->assertSee('Paises');
    }

    /** @test */
    public function can_search_for_a_pais()
    {

        $response = $this->actingAs($this->user)->get('paises?search=' . $this->pais->nombre);

        $response->assertStatus(200);

        $response->assertSee($this->pais->nombre);
    }

    /** @test */
    public function can_see_pais_create_page()
    {
        $response = $this->actingAs($this->user)->get(route('paises.create'));

        $response->assertStatus(200);

        $response->assertSee('Crear País');
    }

    /** @test */
    public function can_see_edit_pais_page()
    {

        $response = $this->actingAs($this->user)->get("/paises/{$this->pais->id}/edit");

        $response->assertStatus(200);

        $response->assertSee('Editar País');
    }


    /** @test */
    public function can_add_a_country()
    {

        $this->post('/paises', $this->pais->toArray());

        $this->assertDatabaseHas(
            'paises',
            [
                'codigo_pais' => $this->pais->codigo_pais,
                'nombre' => $this->pais->nombre
            ]
        );
    }

    /** @test */
    public function fields_required()
    {
        $pais = [];

        $response = $this->post('paises', $pais);

        $response->assertSessionHasErrors(['codigo_pais', 'nombre']);
    }

    /** @test */
    public function error_404_if_country_to_update_not_found()
    {

        $response = $this->put('paises/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_update_a_country()
    {

        $pais = Pais::factory()->create([
            'codigo_pais' => 'RU',
            'nombre' =>  'Rusia'
        ]);

        $this->put('paises/' . $pais->id, $pais->toArray());

        $this->assertDatabaseHas(
            'paises',
            [
                'codigo_pais' => 'RU',
                'nombre' => 'Rusia'
            ]
        );
    }

    /** @test */
    public function error_404_if_country_to_delete_not_found()
    {

        $response = $this->delete('paises/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_delete_a_country()
    {
        $this->delete('paises/' . $this->pais->id);

        $this->assertDatabaseMissing('paises', $this->pais->toArray());
    }
}
