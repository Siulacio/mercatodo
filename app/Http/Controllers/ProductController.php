<?php

namespace App\Http\Controllers;

use App\Actions\Admin\Files\StoreFileAction;
use App\Actions\Admin\Products\StoreProductAction;
use App\Exports\ProductsExport;
use App\Models\Product;
use App\Events\ProductSaved;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ProductController extends Controller
{

    public function index() : Collection
    {
        return Product::get();
    }

    public function store(
        ProductStoreRequest $request,
        Product $product,
        StoreProductAction $storeProductAction,
        StoreFileAction $storeFileAction) : void
    {
        $storeProductAction->execute($request->validated(), $product);

        if ($request->hasFile('images')){
            $storeFileAction->uploadFiles($request, $product);
        }
    }

    public function show(Product $product) : Product
    {
        return $product;
    }

    public function update(
        ProductStoreRequest $request,
        Product $product,
        StoreFileAction $storeFileAction) : void
    {
        $product->update($request->validated());

        if ($request->hasFile('images')){
            $storeFileAction->uploadFiles($request, $product);
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
        $filter = $request->search;

        return Product::searchProduct($filter)
            ->where('state',1)
            ->with(['images'=>function($query){
                $query->first();
            }])
            ->paginate($per_page);
    }

    public function exportExcel() : BinaryFileResponse
    {
        return Excel::download(new ProductsExport(), 'product-list.xlsx');
    }
}
