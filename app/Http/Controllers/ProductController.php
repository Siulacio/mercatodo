<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Events\ProductSaved;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;


class ProductController extends Controller
{

    public function index() : Collection
    {
        return Product::get();
    }

    public function store(ProductStoreRequest $request) : void
    {
        $product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'state' => $request->state,
        ]);

        if ($request->hasFile('images')){
            $this->uploadFiles($request, $product);
        }
    }

    public function show(Product $product) : Product
    {
        return $product;
    }

    public function update(ProductStoreRequest $request, Product $product) : void
    {
        $product->update($request->all());

        if ($request->hasFile('images')){
            $this->uploadFiles($request, $product);
        }
    }

    public function changeState(int $id) : void
    {
        Product::find($id)->toggleState()->save();
    }

    public function showProductImages(Product $product) : Collection
    {
        return ProductImages::where('product_id',$product->id)->get();
    }

    public function destroyImage(int $id) : void
    {
        $image = ProductImages::find($id);
        Storage::disk('public')->delete($image->image);
        $image->delete();
    }

    public function showcase(Request $request) : LengthAwarePaginator
    {
        $per_page = $request->per_page;
        return Product::where('state',1)->paginate($per_page);
    }

    private function uploadFiles(Request $request, Product $product) : void
    {
        foreach ( $request->file('images') as $image){
            $image->store('images', 'public');
            $newImage = ProductImages::create([
                'product_id' => $product->id,
                'name' => $image->getClientOriginalName(),
                'image' => $image->store('images', 'public')
            ]);

            //optimize images
            ProductSaved::dispatch($newImage);
        }
    }
}
