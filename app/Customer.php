<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable=['branch_code','full_name','national_id','account','email','phone','address'];
}
