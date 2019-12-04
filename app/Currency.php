<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Currency extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['currency_code','currency_name'];
}
