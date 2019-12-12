<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Installment extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['loan_id','amount','currency','ft_reference','effective_date','captured_by','status','authorised_by','branch'];
    public function days($frequency){
        $freq=Repayment::where('frequency_number',$frequency)->first();
        if($freq->frequency_number=='12'){
            $days=30;
        }
        elseif($freq->frequency_number=='2'){
            $days=180;
        }
        elseif($freq->frequency_number=='4'){
            $days=90;
        }
        elseif($freq->frequency_number=='1'){
            $days=365;
        }
        return $days;
    }

    public function StatusName($code){
        $name=Status::where('status_code',$code)->first();
        return $name->status_name;


    }
}
