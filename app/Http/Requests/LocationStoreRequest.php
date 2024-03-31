<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class LocationStoreRequest extends FormRequest
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
        return Auth::user()->can('localizacao.criar');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'link' => 'nullable|string',
            'number_county' => 'nullable|integer',
            'number_region' => 'nullable|integer',
            'description' => 'nullable|string',
            'active' => 'boolean',
            'sorting' => '1|0',
        ];
    }
}
