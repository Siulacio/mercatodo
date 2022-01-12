<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductStoreRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        $product = $this->product->id ?? "";

        return [
            'code' => 'required|numeric|unique:products,code,'.$product,
            'name' => 'required|min:5',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'state' => 'required',
            'images.*' => 'image|max:2000',
        ];
    }

    public function messages()
    {
        return [
            'images.*.image' => 'El archivo debe ser una imagen.',
            'images.*.max' => 'El archivo no debe superar los 2MB.',
        ];
    }
}
