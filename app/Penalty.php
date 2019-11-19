<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    //
    protected $fillables=[
      'loan_id',
      'remaining_installments',
      'installment_fee',
      'frequency',
      'penalty_fee',
       'cleared_installments',
       'due_date',
       'last_payment'
    ];
}
