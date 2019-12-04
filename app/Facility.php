<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Facility extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['facility_name','facility_description'];
}
