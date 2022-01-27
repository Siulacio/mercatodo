<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_list_can_be_retrieved() : void
    {
        $this->withoutExceptionHandling();
        Product::factory(2)->create();

        $response = $this->getJson('api/products');

        $response->assertOk();
    }

    public function test_response_is_json() : void
    {
        $response = $this->getJson('api/products');
        $response->assertHeader('content-type','application/json');
    }

    public function test_a_product_can_be_created() : void
    {
        $product = $this->productData();

        $response = $this->post('api/products', $product);

        $new_product = Product::first();
        $this->assertEquals('000002',$new_product->code);
    }

    public function test_a_product_can_be_updated():void
    {
        $product = Product::factory()->create();

        $response = $this->put("api/products/{$product->id}",[
            'code' => '002036',
            'name' => 'new name',
            'description' => 'new description',
            'price' => 500,
            'quantity' => 9,
            'state'=>0
        ]);

        $product = $product->fresh();
        $this->assertEquals('002036', $product->code);
    }

    public function test_a_product_can_be_deleted() : void
    {
        $product = Product::factory()->create();
        $response = $this->delete("api/products/{$product->id}");
        $this->assertCount(0, Product::all());
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
