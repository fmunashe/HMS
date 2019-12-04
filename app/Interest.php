<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Interest extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['interest_percentage'];
}
