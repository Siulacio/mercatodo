<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductImportRequest extends FormRequest
{

    public function authorize() : bool
    {
        return true;
    }


    public function rules() : array
    {
        return [
            'file'=>['bail','required','file','max:2000','mimes:xlsx, xls']
        ];
    }

    public function messages() : array
    {
        return [
            'file.required'=>'El archivo es requerido',
            'file.mimes'=>'El archivo debe tener la extensión .xlsx',
            'file.max'=>'El archivo no debe superar los 2MB',
        ];
    }
}
