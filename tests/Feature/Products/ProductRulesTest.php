<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_require_a_code() : void
    {
        $product = $this->productData(['code'=>null]);

        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors'=>['code']]);
    }

    public function test_a_product_code_must_be_numeric() : void
    {
        $product = $this->productData(['code'=>'GGS']);

        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors'=>['code']]);
    }

    public function test_a_product_name_require_a_minimum_length() : void
    {
        $product = $this->productData(['name'=>'NS']);

        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors'=>['name']]);
    }

    public function test_a_product_code_must_be_unique() : void
    {
        $product = $this->productData();

        $this->postJson('/products', $product);
        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors']);
    }

    public function test_a_product_require_a_name() : void
    {
        $product = $this->productData(['name'=>null]);

        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors'=>['name']]);
    }

    public function test_a_product_require_a_description() : void
    {
        $product = $this->productData(['description'=>null]);

        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors'=>['description']]);
    }

    public function test_a_product_require_a_price() : void
    {
        $product = $this->productData(['price'=>null]);

        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors'=>['price']]);
    }

    public function test_a_product_require_a_quantity() : void
    {
        $product = $this->productData(['quantity'=>null]);

        $response = $this->postJson('/products', $product);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors'=>['quantity']]);
    }

    public function productData( $overrides = []) : array
    {
        return array_merge([
                'code'=> '000002',
                'name'=>'product name',
                'description'=> 'first product description',
                'price'=>'2000',
                'quantity'=>'5',
                'state'=>true,
        ], $overrides);
    }
}
