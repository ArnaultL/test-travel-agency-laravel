<?php

namespace Tests\Feature;

use App\Models\Travel;
use Tests\TestCase;

class TravelTest extends TestCase
{
    /**
     * Create a travel and redirect to travels list
     *
     * @return void
     */
    public function test_should_create_a_travel_and_redirect()
    {
        $travel = Travel::factory()->create();
        $response = $this->post('travels/add', [
            'name' => $travel->name,
        ]);
        $response->assertRedirect('travels');
    }
    
}
