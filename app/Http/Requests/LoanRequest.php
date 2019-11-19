<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
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
            'facility_category'=>'required',
            'client_id'=>'required|regex:/^([0-9]{2})+(-[0-9]{6,7})+([a-zA-Z]{1})+([0-9]{2})+$/',
            'asset_number'=>'required|min:3',
            'loan_amount'=>'required|numeric',
            'establishment_date'=>'required',
            'end_date'=>'required',
            'period'=>'required|numeric',
            'repayment_frequency'=>'required',
            'applicable_interest'=>'required',
            'applicable_penalt'=>'required',
            'total_installments'=>'required',
            'installment_amount'=>'required|numeric',
            'total_amount_payable'=>'required',
         ];
    }
}
