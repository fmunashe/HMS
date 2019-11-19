<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    //
    protected $fillable=['client_id','loan_id','account_number','amount','currency','installment_number','ft_reference','captured_by'];
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

}
