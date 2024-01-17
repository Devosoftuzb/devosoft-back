<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    // use RefreshDatabase;

    public function test_category_creation(): void
    {
        // Arrange
        $categoryData = [
            'name_uz' => 'Test Category',
            'name_en' => 'Test Category (English)',
            'name_ru' => 'Test Category (Russian)',
            'info_uz' => 'Some information in Uzbek',
            'info_en' => 'Some information in English',
            'info_ru' => 'Some information in Russian',
        ];

        // Act
        $response = $this->post('/api/categories', $categoryData);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name_uz' => 'Test Category']);
    }

    public function test_category_creation_validation(): void
    {
        // Act
        $response = $this->post('/api/categories', []);

        // Assert
        $response->assertStatus(302); // Expecting a redirect for validation failure
        $response->assertSessionHasErrors(['name_uz', 'name_en', 'name_ru', 'info_uz', 'info_en', 'info_ru']);
    }

    public function test_category_update(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $updatedCategoryData = [
            'name_uz' => 'Updated Category',
            'name_en' => 'Updated Category (English)',
            'name_ru' => 'Updated Category (Russian)',
            'info_uz' => 'Updated information in Uzbek',
            'info_en' => 'Updated information in English',
            'info_ru' => 'Updated information in Russian',
        ];

        // Act
        $response = $this->put("/api/categories/{$category->id}", $updatedCategoryData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['name_uz' => 'Updated Category']);
    }


    public function test_category_view(): void
    {
        // Arrange
        $category = Category::factory()->create();

        // Act
        $response = $this->get("/api/categories/{$category->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
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

    public function test_category_deletion(): void
    {
        // Arrange
        $category = Category::factory()->create();

        // Act
        $response = $this->delete("/api/categories/{$category->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
