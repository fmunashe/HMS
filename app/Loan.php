<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Loan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
        'optional_collateral',
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
    public function FrequencyName($frequency_number){
        $name=Repayment::where('frequency_number','=',$frequency_number)->first();
        return $name->frequency_name;
    }

    public function BranchName($code){
        $name=Branch::where('branch_code',$code)->first();
        return $name->branch_name;
    }
    public function ClientName($code){
    $name=Customer::query()->where('national_id',$code)->first();
    return $name->full_name;
    }
}
