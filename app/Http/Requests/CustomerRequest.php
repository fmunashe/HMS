<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            //
            'branch_code'=>'required',
            'full_name'=>'required',
            'account'=>'required|min:12',
            'national_id'=>'required|regex:/^([0-9]{2})+(-[0-9]{6,7})+([a-zA-Z]{1})+([0-9]{2})+$/',
            'email'=>'required|email|unique:customers',
            'phone'=>'required|numeric|digits_between:5,12',
            'address'=>'required|min:5'
        ];
    }
}
