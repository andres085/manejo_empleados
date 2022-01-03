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
    /**
     * A basic feature test example.
     *
     * @return void
     */

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
    public function can_get_countries()
    {

        $response = $this->actingAs($this->user)
            ->get('/paises');

        $response->assertSeeText('Paises');
        $response->assertSeeText('Crear País');
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
