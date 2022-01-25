<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowProductsTest extends TestCase
{
    public function test_it_paginates() : void
    {
        $this->withoutExceptionHandling();

        Product::factory(4)->create();

        $response = $this->get('/showcase');

        $response->assertSuccessful();
        $response->assertJson([
            'total'=>4
        ]);

        $response->assertJsonStructure([
            'data', 'total', 'first_page_url', 'last_page_url'
        ]);
    }
}
