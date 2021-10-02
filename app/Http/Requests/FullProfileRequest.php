<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class FullProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first-name' => 'required|min:2|max:50',
            'last-name' => 'nullable|min:2|max:50',
            'email' => 'required|email|unique:users,email,' . Session::get('user_id'),
            'password' => 'required|min:6|unique:users,password,' . Session::get('user_id'),
            'address' => 'nullable|string|unique:user_details,address,' . Session::get('user_id') . ',u_id',
            'city' => 'nullable|string|max:30|min:2',
            'country' => 'nullable|string|max:40|min:2',
            'file' => 'nullable|file|max:512|mimes:jpeg,jpg,svg,png',
        ];
    }
}
