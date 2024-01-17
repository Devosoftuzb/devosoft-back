<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{

    use RefreshDatabase;

    public function test_service_creation(): void
    {
        $category = Category::factory()->create();
        // Arrange
        $serviceData = [
            'category_id' => $category->id,
            'name_uz' => 'Test Service',
            'name_en' => 'Test Service (English)',
            'name_ru' => 'Test Service (Russian)',
            'info_uz' => 'Some information in Uzbek',
            'info_en' => 'Some information in English',
            'info_ru' => 'Some information in Russian',
        ];

        // Act
        $response = $this->post('/api/services', $serviceData);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('services', ['name_uz' => 'Test Service']);

    }

    public function test_service_creation_validation(): void
    {
        // Act
        $response = $this->post('/api/services', []);

        // Assert
        $response->assertStatus(302); // Expecting a redirect for validation failure
        $response->assertSessionHasErrors(['category_id', 'name_uz', 'name_en', 'name_ru', 'info_uz', 'info_en', 'info_ru']);
    }

    public function test_service_update(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        $updatedServiceData = [
            'category_id' => $category->id,  // Ensure it references an existing category
            'name_uz' => 'Updated Service',
            'name_en' => 'Updated Service (English)',
            'name_ru' => 'Updated Service (Russian)',
            'info_uz' => 'Updated information in Uzbek',
            'info_en' => 'Updated information in English',
            'info_ru' => 'Updated information in Russian',
        ];

        // Act
        $response = $this->put("/api/services/{$service->id}", $updatedServiceData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('services', ['name_uz' => 'Updated Service']);
    }



    public function test_service_view(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        // Act
        $response = $this->get("/api/services/{$service->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'category_id',
            'name_uz',
            'name_en',
            'name_ru',
            'info_uz',
            'info_en',
            'info_ru',
            'created_at',
            'updated_at',
        ]);
    }

    public function test_service_deletion(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        // Act
        $response = $this->delete("/api/services/{$service->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
