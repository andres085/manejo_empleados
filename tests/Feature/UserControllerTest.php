<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserControllerTest extends TestCase
{

    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function can_create_a_user()
    {
        $user = User::factory()->create();

        $this->post('users', $user->toArray());

        $this->assertDatabaseHas('users', [
            'nombre' => $user->nombre,
        ]);
    }

    /** @test */
    public function can_update_a_user()
    {
        $user = User::factory()->create([
            'nombre' => 'Paco',
        ]);

        $this->put('users', $user->toArray());

        $this->assertDatabaseHas('users', [
            'nombre' => 'Paco',
        ]);
    }

    /** @test */
    public function can_delete_a_user()
    {
        $user = User::factory()->create();
        $this->delete('users/' . $user->id);

        $this->actingAs($this->user)->assertDatabaseMissing('users', $user->toArray());
    }
}
