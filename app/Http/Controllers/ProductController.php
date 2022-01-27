<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Events\ProductSaved;
use App\Models\ProductImages;
use App\Imports\ProductsImport;
use App\Exports\ProductsExport;
use Illuminate\Http\JsonResponse;
use App\Jobs\NotifyCompleteExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductImportRequest;
use App\Actions\Admin\Files\StoreFileAction;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Actions\Admin\Products\StoreProductAction;


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
        StoreFileAction $storeFileAction) : JsonResponse
    {
        $storeProductAction->execute($request->validated(), $product);

        if ($request->hasFile('images')){
            $storeFileAction->uploadFiles($request, $product);
        }

        return response()->json(['message'=>'Producto almacenado exitosamente']);
    }

    public function show(Product $product) : Product
    {
        return $product;
    }

    public function update(
        ProductStoreRequest $request,
        Product $product,
        StoreFileAction $storeFileAction) : JsonResponse
    {
        $product->update($request->validated());

        if ($request->hasFile('images')){
            $storeFileAction->uploadFiles($request, $product);
        }
        return response()->json(['message'=>'Producto actualizado exitosamente']);
    }


    public function changeState(int $id) : void
    {
        Product::find($id)->toggleState()->save();
    }


    public function showProductImages(Product $product) : Collection
    {
        return ProductImages::where('product_id',$product->id)->get();
    }


    public function destroyImage(int $id) : JsonResponse
    {
        $image = ProductImages::find($id);
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return response()->json(['message'=>'Imagen eliminada exitosamente']);
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


    public function exportExcel() : JsonResponse
    {
        $fileName = 'exports/product_list_'.date('Y-m-d-H-m-s').'.xlsx';
        $filePath = asset('storage/'.$fileName);
        $user = auth()->user();

        (new ProductsExport)->store($fileName, 'public')->chain([
            new NotifyCompleteExport($user, $filePath)
        ]);

        return response()->json(['message'=>'La exportación ha comenzado.<br> te enviaremos un email una vez finalizado.']);
    }


    public function importExcel(ProductImportRequest $request) : JsonResponse
    {
        Excel::import(new ProductsImport, $request->file('file'));
        return response()->json(['message'=>'Importación exitosa.']);
    }
}
