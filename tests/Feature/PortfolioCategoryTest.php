<?php

namespace Tests\Feature;

use App\Models\Portfolio_Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PortfolioCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_portfolio_category(): void
    {
        // Arrange
        $portfolioCategoryData = [
            'name_uz' => 'Test portfolio_category',
            'name_en' => 'Test portfolio_category (English)',
            'name_ru' => 'Test portfolio_category (Russian)',
        ];

        // Act
        $response = $this->post('/api/portfolio__categories', $portfolioCategoryData);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('portfolio__categories', ['name_uz' => 'Test portfolio_category']);
    }

    public function test_it_can_validate_portfolio_category(): void
    {
        // Act
        $response = $this->post('/api/portfolio__categories', []);

        // Assert
        $response->assertStatus(302); // Expecting a redirect for validation failure
        $response->assertSessionHasErrors(['name_uz', 'name_en', 'name_ru']);
    }

    public function test_it_can_update_portfolio_category(): void
    {
        // Arrange
        $portfolioCategory = Portfolio_Category::factory()->create();
        $updatedportfolioCategoryData = [
            'name_uz' => 'Updated portfolio_category',
            'name_en' => 'Updated portfolio_category (English)',
            'name_ru' => 'Updated portfolio_category (Russian)',
        ];

        // Act
        $response = $this->put("/api/portfolio__categories/{$portfolioCategory->id}", $updatedportfolioCategoryData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('portfolio__categories', ['name_uz' => 'Updated portfolio_category']);
    }


    public function test_category_view(): void
    {
        // Arrange
        $portfolioCategory = Portfolio_Category::factory()->create();

        // Act
        $response = $this->get("/api/portfolio__categories/{$portfolioCategory->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name_uz',
            'name_en',
            'name_ru',
        ]);
    }

    public function test_category_deletion(): void
    {
        // Arrange
        $portfolioCategory = Portfolio_Category::factory()->create();

        // Act
        $response = $this->delete("/api/portfolio__categories/{$portfolioCategory->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('portfolio__categories', ['id' => $portfolioCategory->id]);
    }
}
