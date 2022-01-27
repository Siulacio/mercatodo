<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Products\StoreProductAction;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Product;

class ApiProductsController extends Controller
{

    public function index() : Collection
    {
        return Product::all();
    }


    public function store(ProductStoreRequest $request, Product $product, StoreProductAction $storeProductAction) : void
    {
        $storeProductAction->execute($request->validated(), $product);
    }

    public function show($id) : Product
    {
        return Product::find($id);
    }


    public function update(ProductStoreRequest $request, $id) : void
    {
        $product = Product::find($id);
        $product->fill($request->validated())->update();
    }


    public function destroy($id) : void
    {
        Product::destroy($id);
    }
}
