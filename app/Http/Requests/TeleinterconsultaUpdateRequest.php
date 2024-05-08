<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TeleinterconsultaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!Auth::check()){
            return false;
        }
        return Auth::user()->can(['teleinterconsulta.visualizar','teleinterconsulta.editar']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'title'=>'required|string',
            'text'=>'string',
            'path_image'=>'file|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'active'=>'boolean',
            'sorting'=>'1|0'
        ];
    }
}
