<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reject extends Model
{
    protected $fillable=[
        'account_number',
        'loan_id',
        'client_id',
        'loan_amount',
        'establishment_date',
        'end_date',
        'period',
        'repayment_frequency',
        'applicable_interest',
        'applicable_penalt',
        'collateral',
        'total_amount_payable',
        'status',
        'captured_by',
        'authorised_by',
        'paid_amount',
        'outstanding',
        'total_installments',
        'facility_category',
        'branch',
        'installment_amount',
    ];
    public function StatusName($code){
        $name=Status::where('status_code','=',$code)->first();
        return $name->status_name;
    }
}
