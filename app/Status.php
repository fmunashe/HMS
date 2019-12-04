<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Status extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['status_code','status_name'];
}
