<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class LoanSchedule extends Model implements Auditable
{
    use Notifiable;
    use \OwenIt\Auditing\Auditable;
    protected $fillable=[
        'loan_id',
        'period',
        'opening_balance',
        'interest',
        'installment',
        'capital_repayment',
        'closing_balance',
        'overdue',
        'paid_amount',
        'status',
        'start_date',
        'end_date'
    ];
}
