<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SneakerControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_view_the_list_of_sneakers()
    {
        $response = $this->get('/sneakers');
        $response->assertStatus(200);
        $response->assertViewIs('sneakers.index');
    }

    /** @test */
    public function it_can_view_a_single_sneaker()
    {
        $sneaker = \App\Models\Sneaker::factory()->create();
        $response = $this->get("/sneakers/{$sneaker->id}");
        $response->assertStatus(200);
        $response->assertViewIs('sneakers.show');
    }

    /** @test */
    public function it_can_create_a_new_sneaker()
    {
        $response = $this->post('/sneakers', [
            'brand' => 'Nike',
            'colorway' => 'Red/White',
            'estimatedMarketValue' => 200,
            'gender' => 'men',
            'image' => 'url_to_image',
            'links' => 'url_to_links',
            'name' => 'Nike Air Max',
            'release_date' => '2023-01-01',
            'release_year' => '2023',
            'retail_price' => 150,
            'silhouette' => 'Air Max',
            'sku' => '123456',
            'story' => 'Some story',
            'uid' => 'unique-identifier',
        ]);

        $response->assertRedirect('/sneakers');
        $this->assertDatabaseHas('sneakers', [
            'name' => 'Nike Air Max',
        ]);
    }

    /** @test */
    public function it_can_update_a_sneaker()
    {
        $sneaker = \App\Models\Sneaker::factory()->create();
        $response = $this->put("/sneakers/{$sneaker->id}", [
            'name' => 'Updated Nike Air Max',
        ]);
        $response->assertRedirect('/sneakers');
        $this->assertDatabaseHas('sneakers', [
            'name' => 'Updated Nike Air Max',
        ]);
    }

    /** @test */
    public function it_can_delete_a_sneaker()
    {
        $sneaker = \App\Models\Sneaker::factory()->create();
        $response = $this->delete("/sneakers/{$sneaker->id}");
        $response->assertRedirect('/sneakers');
        $this->assertDatabaseMissing('sneakers', [
            'id' => $sneaker->id,
        ]);
    }
}