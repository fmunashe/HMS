<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallmentRequest extends FormRequest
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
            'client_id'=>'required|regex:/^([0-9]{2})+(-[0-9]{6,7})+([a-zA-Z]{1})+([0-9]{2})+$/',
            'loan_id'=>'required',
            'amount'=>'required',
            'currency'=>'required',
            'account_number'=>'required',
            'installment_number'=>'required|numeric',
            'ft_reference'=>'required|size:12|regex:/^(FT[0-9]{5})+([A-Z]{5})+$/',
        ];
    }
}
