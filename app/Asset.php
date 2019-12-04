<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Asset extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $fillable=['asset_number','asset_name','serial_number','asset_value','asset_description','status'];
    public function AssetStatus($code){
        $name=Status::where('status_code','=',$code)->first();
        return $name->status_name;
    }

    public function ClientId($asset_code){
    $loanId=AssetLoan::where('asset_number',$asset_code)->first();
    $clientId=Loan::where('loan_id',$loanId->loan_id)->first();
    return $clientId->client_id;
    }
    public function Branch($asset_code){
        $loanId=AssetLoan::where('asset_number',$asset_code)->first();
        $clientId=Loan::where('loan_id',$loanId->loan_id)->first();
        $branch=Customer::where('national_id',$clientId->client_id)->first();
        $name=Branch::where('branch_code',$branch->branch_code)->first();
        return $name->branch_name;
    }
}
