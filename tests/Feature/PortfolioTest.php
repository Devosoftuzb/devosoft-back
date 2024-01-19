<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\Portfolio_Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_portfolio(): void
    {
        $fakeImage = UploadedFile::fake()->image('fake_image.jpg');
        $portfolioCategory = Portfolio_Category::factory()->create();
        // Arrange
        $portfolioData = [
            'portfolio__category_id' => $portfolioCategory->id,
            'name' => 'Test Portfolio',
            'link' => 'Test Link',
            'image' => $fakeImage,
        ];

        // Act
        $response = $this->post('/api/portfolios', $portfolioData);

        // Assert
        // $response->assertStatus(201);
        $this->assertDatabaseHas('portfolios', ['name' => 'Test Portfolio']);

    }

    public function test_it_can_validate_creation_portfolio(): void
    {
        // Act
        $response = $this->post('/api/portfolios', []);

        // Assert
        $response->assertStatus(302); 
        $response->assertSessionHasErrors(['portfolio__category_id', 'name', 'link', 'image' => 'The image field is required.']);
    } 

    public function test_it_can_update_portfolio(): void
    {
        // Arrange
        $portfolioCategory = Portfolio_Category::factory()->create();
        $portfolio = Portfolio::factory()->create(['portfolio__category_id' => $portfolioCategory->id]);
        $fakeImage = UploadedFile::fake()->image('updated_image.png');

        $updatedPortfolioData = [
            'portfolio__category_id' => $portfolioCategory->id,
            'name' => 'Updated Portfolio',
            'link' => 'Updated Link',
            'image' => $fakeImage,
        ];

        // Act
        $response = $this->put("/api/portfolios/{$portfolio->id}", $updatedPortfolioData);

        // Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('portfolios', ['name' => 'Updated Portfolio']);
    }



    public function test_it_can_view_portfolio(): void
    {
        // Arrange
        $portfolioCategory = Portfolio_Category::factory()->create();
        $portfolio = Portfolio::factory()->create(['portfolio__category_id' => $portfolioCategory->id]);

        // Act
        $response = $this->get("/api/portfolios/{$portfolio->id}");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'portfolio__category_id',
            'name',
            'image',
            'link',
        ]);
    }

    public function test_service_deletion(): void
    {
        // Arrange
        $portfolioCategory = Portfolio_Category::factory()->create();
        $portfolio = Portfolio::factory()->create(['portfolio__category_id' => $portfolioCategory->id]);

        // Act
        $response = $this->delete("/api/portfolios/{$portfolio->id}");

        // Assert
        $response->assertStatus(204);
        $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);
    }
}
