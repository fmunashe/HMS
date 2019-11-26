<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //
    protected $fillable=['asset_number','asset_name','serial_number','asset_value','asset_description','status'];
    public function AssetStatus($code){
        $name=Status::where('status_code','=',$code)->first();
        return $name->status_name;
    }
}
