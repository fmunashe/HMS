<?php

use App\Loan;
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/realtime',function(){
    $loans=User::all()->groupBy('branch')->count();
return ['value'=>$loans];
   // ['value'=>rand(100,1000000)];
})->name('realtime');
