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
    public function can_add_a_province()
    {

        $this->post('provincias', $this->provincia->toArray());

        $this->assertDatabaseHas('provincias', [
            'pais_id' => $this->provincia->pais_id,
            'nombre' => $this->provincia->nombre
        ]);
    }

    /** @test */
    public function name_is_required()
    {
        $provincia = Provincia::create();

        $response = $this->post('provincias', $provincia->toArray());

        $response->assertSessionHasErrors(['pais_id', 'nombre']);
    }


    /** @test */
    public function can_get_provinces()
    {
        $response = $this->get('/provincias');

        $response->assertSeeText('Provincias');
        $response->assertSeeText('Crear Provincia');
    }

    /** @test */
    public function error_404_if_province_not_found()
    {
        $response = $this->put('provincias/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_edit_a_province()
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
    public function can_delete_a_province()
    {
        $this->delete('provincias/' . $this->provincia->id);

        $this->assertDatabaseMissing('provincias', $this->provincia->toArray());
    }
}
