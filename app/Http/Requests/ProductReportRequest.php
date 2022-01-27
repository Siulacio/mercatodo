<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductReportRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'fecha_inicial'=>['required'],
            'fecha_final'=>['required'],
            'state'=>['required'],
        ];
    }

    public function messages() : array
    {
        return [
            'fecha_inicial.required'=>'la fecha inicial es requerida',
            'fecha_final.required'=>'la fecha final es requerida',
            'state.required'=>'el estado es requerido',
        ];
    }
}
