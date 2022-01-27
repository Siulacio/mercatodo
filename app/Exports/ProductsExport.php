<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;


class ProductsExport implements FromCollection, ShouldQueue
{
    use Exportable;

    public function collection() : Collection
    {
        return Product::select("code","name","description","price","quantity","state")->get();
    }
}
