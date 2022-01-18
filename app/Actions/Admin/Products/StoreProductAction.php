<?php

namespace App\Actions\Admin\Products;

use App\Models\Product;

class StoreProductAction
{
    public function execute(array $data, Product $product) : Product
    {
        $product->code = $data['code'];
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->state = $data['state'];
        $product->save();

        return $product;
    }
}
