<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    public function collection() : Collection
    {
        return Product::select("code","name","description","price","quantity","state")->get();
    }
}
