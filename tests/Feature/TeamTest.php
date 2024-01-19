<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_can_create_team(): void
    {
        // Arrange
        $fakeImage = UploadedFile::fake()->image('fake_image.jpg');
        
        $TeamData = [
            'name' => 'Test Team',
            'position' => 'Test position',
            'image' => $fakeImage,
            'telegram' => 'Test telegram',
            'instagram' => 'Test instagram',
            'linkidin' => 'Test linkidin',
        ];

        // Act
        $response = $this->post('/api/teams', $TeamData);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('teams', ['name' => 'Test Team']);
    }

    public function test_it_can_validate_creation_team(): void
    {
        // Act
        $response = $this->post('/api/teams', []);

        // Assert
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name', 'position', 'telegram', 'instagram', 'linkidin', 'image' => 'The image field is required.'
        ]);
    }

    public function test_it_can_update_team(): void
    {
        // Arrange
        $team = Team::factory()->create();

        $fakeImage = UploadedFile::fake()->image('updated_image.png');

        $updatedTeamData = [
            'name' => 'Updated Team',
            'position' => 'Updated position',
            'image' => $fakeImage,
            'telegram' => 'Updated telegram',
            'instagram' => 'Updated instagram',
            'linkidin' => 'Updated linkidin',
        ];

        // Act
        $response = $this->put("/api/teams/{$team->id}", $updatedTeamData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('teams', ['name' => 'Updated Team']);
    }


    public function test_it_can_view_team(): void
    {
        // Arrange
        $team = Team::factory()->create();

        // Act
        $response = $this->get("/api/teams/{$team->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'name',
            'position',
            'image',
            'telegram',
            'instagram',
            'linkidin',
        ]);
    }

    public function test_it_can_delete_team(): void
    {
        // Arrange
        $team = Team::factory()->create();

        // Act
        $response = $this->delete("/api/teams/{$team->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    }
}
