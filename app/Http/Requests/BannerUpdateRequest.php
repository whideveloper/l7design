<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BannerUpdateRequest extends FormRequest
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
        return Auth::user()->can('banners.editar banner');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date'=>'required',
            'end_date'=>'required',
            'link'=>'string|url|nullable',
            'path_image'=>'file|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'active'=>'boolean',
            'path_image_mobile'=>'file|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'sorting'=>'1|0'
        ];
    }
}
