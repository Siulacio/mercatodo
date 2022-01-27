<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows) : void
    {
        Validator::make($rows->toArray(), [
            '*.0' => 'required',
        ])->validate();

        foreach ($rows as $row){
            Product::updateOrCreate(
                [
                    'code'=>$row[0]
                ],
                [
                    'code' => $row[0],
                    'name' => $row[1],
                    'description' => $row[2],
                    'price' => $row[3],
                    'quantity' => $row[4],
                    'state' => $row[5],
                ]
            );
        }
    }
}
