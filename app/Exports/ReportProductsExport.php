<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportProductsExport implements FromQuery, ShouldQueue
{
    use Exportable;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query() : Builder
    {
        return Product::query()->where('state',$this->request['state'])
            ->whereDate('created_at', '>=', $this->request['fecha_inicial'])
            ->whereDate('created_at', '<=', $this->request['fecha_final']);
    }

}
