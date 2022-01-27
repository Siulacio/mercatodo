<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Jobs\NotifyCompleteExport;
use App\Exports\ReportProductsExport;
use App\Http\Requests\ProductReportRequest;

class ReportController extends Controller
{

    public function productReport(ProductReportRequest $request) : JsonResponse
    {
        $fileName = 'reports/products/report_'.date('Y-m-d-H-m-s').'.xlsx';
        $filePath = asset('storage/'.$fileName);
        $user = auth()->user();

        (new ReportProductsExport($request->validated() ))->store($fileName, 'public')->chain([
            new NotifyCompleteExport($user, $filePath)
        ]);

        return response()->json(['message'=>'Reporte en generación, te enviaremos un email con el reporte al finalizar']);
    }
}
