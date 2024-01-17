<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_creation(): void
    {
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);

        // Arrange
        $contactData = [
            'name' => 'Test Name',
            'number' => 1234567,
            'description' => 'Test description',
            'service_id' => $service->id,
        ];

        // Act
        $response = $this->post('/api/contacts', $contactData);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('contacts', ['name' => 'Test Name']);
    }


    public function test_contact_creation_validation(): void
    {
         // Act
         $response = $this->post('/api/contacts', []);

         // Assert
         $response->assertStatus(302); // Expecting a redirect for validation failure
         $response->assertSessionHasErrors([
            'name', 
            'number', 
            'description', 
            'service_id',
        ]);
    }

    public function test_contact_view(): void
    {
        // Arrange
        $category = Category::factory()->create();
        $service = Service::factory()->create(['category_id' => $category->id]);
        $contact = Contact::factory()->create(['service_id' => $service->id]);

        // Act
        $response = $this->get("/api/contacts/{$contact->id}");

        // Assert
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'number',
                'description',
                'service_name',
            ],
        ]);
    }

}
