<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use withFaker, RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_page_redirects_to_business_listings_page()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }
}
