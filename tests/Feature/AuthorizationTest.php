<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_can_manage_users()
    {
        // Créer un utilisateur avec le rôle 'owner'
        $owner = User::factory()->create([
            'role' => 'owner',
        ]);

        // Vérifier que l'owner peut accéder à la route
        $response = $this->actingAs($owner)
                         ->post('/manage-users'); // Assurez-vous que l'URL est correcte

        $response->assertStatus(200);  // Attendre une réponse réussie (200)
    }
}