<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class Customer extends Model implements Auditable
{
    //
    use Notifiable;
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['branch_code','full_name','national_id','account','email','phone','address'];

    public function BranchName($code){
        $name=Branch::where('branch_code',$code)->first();
        return $name->branch_name;
    }
}
