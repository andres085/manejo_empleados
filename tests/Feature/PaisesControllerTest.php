<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pais;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
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
    public function test_can_add_a_country()
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
    public function can_get_countries()
    {

        $response = $this->actingAs($this->user)
            ->get('/paises');

        $response->assertStatus(200);
        $response->assertSeeText('Paises');
        $response->assertSeeText('Crear País');
    }

    /** @test */
    public function error_404_if_country_not_found()
    {

        $response = $this->put('paises/-1');

        $response->assertStatus(404);
    }

    /** @test */
    public function can_edit_a_country()
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
    public function can_delete_a_country()
    {
        $this->delete('paises/' . $this->pais->id);

        $this->assertDatabaseMissing('paises', $this->pais->toArray());
    }
}
