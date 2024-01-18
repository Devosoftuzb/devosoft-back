<?php

namespace Tests\Feature;

use App\Models\Advantage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory as Faker;

use Tests\TestCase;

class AdvantageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_advantage(): void
    {
        // Arrange
        $fakeImage = UploadedFile::fake()->image('fake_image.jpg');
        
        $categoryData = [
            'name_uz' => 'Test Advantage',
            'name_en' => 'Test Advantage (English)',
            'name_ru' => 'Test Advantage (Russian)',
            'image' => $fakeImage,
        ];

        // Act
        $response = $this->post('/api/advantages', $categoryData);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('advantages', ['name_uz' => 'Test Advantage']);
    }

    public function test_it_can_validate_creation_advantage(): void
    {
         // Act
         $response = $this->post('/api/advantages', []);

         // Assert
         $response->assertStatus(302); // Expecting a redirect for validation failure
         $response->assertSessionHasErrors([
            'name_uz', 
            'name_en', 
            'name_ru', 
            'image', 
        ]);
    }

    public function test_it_can_update_advantage(): void
    {
       // Arrange
        $advantage = Advantage::factory()->create();

        $updatedAdvantageData = [
            'name_uz' => 'Updated advantage',
            'name_en' => 'Updated advantage (English)',
            'name_ru' => 'Updated advantage (Russian)',
            'image'   => 'updatedimage.jpg',
        ];

        // Act
        $response = $this->put("/api/advantages/{$advantage->id}", $updatedAdvantageData);

        // Assert
        $response->assertStatus(200);

        // Check the updated data in the database
        $this->assertDatabaseHas('advantages', ['name_uz' => 'Updated advantage']);

    }

    public function test_it_can_view_advantage(): void
    {
        // Arrange
        $advantage = Advantage::factory()->create();

        // Act
        $response = $this->get("/api/advantages/{$advantage->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name_uz',
            'name_en',
            'name_ru',
            'image',
        ]);
    }

    public function test_it_can_delete_advantage(): void
    {
        // Arrange
        $advantage = Advantage::factory()->create();

        // Act
        $response = $this->delete("/api/advantages/{$advantage->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('advantages', ['id' => $advantage->id]);
    }

}
