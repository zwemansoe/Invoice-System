<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class request_form_validate extends FormRequest
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
            'invoicename'=>'required',           
            'subtotal'=>'required',
            'tax'=>'required|numeric|min:1',
            'total'=>'required|numeric|min:1'
        ];
    }
}
