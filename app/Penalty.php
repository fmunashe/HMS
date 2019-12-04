<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Penalty extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
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
