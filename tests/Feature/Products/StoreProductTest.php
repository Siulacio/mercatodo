<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_a_product_can_be_created() : void
    {
//        $this->withoutExceptionHandling();

        $product = [
            'code'=>'00001',
            'name'=>'first product',
            'description'=> 'first product description',
            'price'=>'2000',
            'quantity'=>'7',
            'state'=>true,
        ];

        $response = $this->post('/products', $product);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('products', $product);

    }

    public function test_change_product_status() : void
    {
        $product = [
            'code'=>'00007',
            'name'=>'first product',
            'description'=> 'first product description',
            'price'=>'2000',
            'quantity'=>'7',
            'state'=>true,
        ];

        $this->postJson('/products', $product);
        $response = $this->get('/products/change_state/2');

        $response->assertOk();
        $this->assertDatabaseHas('products', ['state'=>false]);
    }

}
