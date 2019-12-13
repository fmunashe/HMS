<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guarantee extends Model
{
    //
    protected $fillable =['guarantee_number','guarantee_type','amount_guaranteed','start_date','end_date','beneficiary','period','security','customer_id','captured_by','authorised_by','status','active','branch'];
    public function GuaranteeType($type){
        $type=GuaranteeType::query()->where('id',$type)->first();
        if($type) {
            return $type->guarantee_type;
        }
    }
    public function Customer($id){
        $customer=Customer::query()->where('national_id',$id)->first();
        if($customer) {
            return $customer->full_name;
        }
    }
    public function Branch($code){
        $branch=Branch::query()->where('branch_code',$code)->first();
        if($branch) {
            return $branch->branch_name;
        }
    }
}
