<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetLoan extends Model
{
    //
    protected $fillable=['loan_id','asset_number'];

    public function AssetName($number){
        $detail=Asset::where('asset_number',$number)->first();
        return $detail->asset_name;
    }
    public function AssetDesc($number){
        $detail=Asset::where('asset_number',$number)->first();
        return $detail->asset_description;
    }
}
