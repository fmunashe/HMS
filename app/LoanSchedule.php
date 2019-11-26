<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    protected $fillable=[
        'loan_id',
        'period',
        'opening_balance',
        'interest',
        'installment',
        'capital_repayment',
        'closing_balance',
        'overdue',
        'start_date',
        'end_date'
    ];
}
