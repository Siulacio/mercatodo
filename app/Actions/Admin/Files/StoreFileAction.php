<?php

namespace App\Actions\Admin\Files;

use App\Models\Product;
use App\Events\ProductSaved;
use Illuminate\Http\Request;
use App\Models\ProductImages;

class StoreFileAction
{
    public function uploadFiles(Request $request, Product $product) : void
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
