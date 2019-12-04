<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Repayment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['frequency_number','frequency_name'];
}
