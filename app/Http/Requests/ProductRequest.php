<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        return [
            'title' => 'required|min:2|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|min:2',
        ];
    }
}
