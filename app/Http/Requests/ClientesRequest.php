<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
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
            'email'     => 'min:6|max:50|required|unique:users',
            'password' => 'min:6|max:20|required',
            'rfc'        => 'min:13|max:13',
            'telefono'   => 'min:7|max:10',
            'usuario'     => 'min:6|max:50|required|unique:users',
        ];
    }
}
