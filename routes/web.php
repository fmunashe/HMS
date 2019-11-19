<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\BranchController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Branch routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/branches','BranchController@index')->name('branches');
Route::get('/createBranch','BranchController@create')->name('createBranch');
Route::post('/createBranch','BranchController@store')->name('createBranch');
Route::get('/editBranch/{branch}','BranchController@edit')->name('editBranch');
Route::get('/deleteBranch/{branch}','BranchController@destroy')->name('deleteBranch');
Route::put('/updateBranch/{branch}','BranchController@update')->name('updateBranch');
//Customers Routes
Route::get('/customers','CustomerController@index')->name('customers');
Route::get('/createCustomer','CustomerController@create')->name('createCustomer');
Route::post('/createCustomer','CustomerController@store')->name('createCustomer');
Route::get('/editCustomer/{customer}','CustomerController@edit')->name('editCustomer');
Route::get('/deleteCustomer/{customer}','CustomerController@destroy')->name('deleteCustomer');
Route::put('/updateCustomer/{customer}','CustomerController@update')->name('updateCustomer');
Route::get('/showCustomer/{customer}','CustomerController@show')->name('showCustomer');
//Product Line Routes
Route::get('/facilities','FacilityController@index')->name('facilities');
Route::get('/createFacility','FacilityController@create')->name('createFacility');
Route::post('/createFacility','FacilityController@store')->name('createFacility');
Route::get('/editFacility/{facility}','FacilityController@edit')->name('editFacility');
Route::get('/deleteFacility/{facility}','FacilityController@destroy')->name('deleteFacility');
Route::put('/updateFacility/{facility}','FacilityController@update')->name('updateFacility');
Route::get('/showFacility/{facility}','FacilityController@show')->name('showFacility');
//Assets Routes
Route::get('/assets','AssetController@index')->name('assets');
Route::get('/createAsset','AssetController@create')->name('createAsset');
Route::post('/createAsset','AssetController@store')->name('createAsset');
Route::get('/editAsset/{asset}','AssetController@edit')->name('editAsset');
Route::get('/deleteAsset/{asset}','AssetController@destroy')->name('deleteAsset');
Route::put('/updateAsset/{asset}','AssetController@update')->name('updateAsset');
Route::get('/showAsset/{asset}','AssetController@show')->name('showAsset');
//Currency Configuration Routes
Route::get('/currencies','CurrencyController@index')->name('currencies');
Route::get('/createCurrency','CurrencyController@create')->name('createCurrency');
Route::post('/createCurrency','CurrencyController@store')->name('createCurrency');
Route::get('/editCurrency/{currency}','CurrencyController@edit')->name('editCurrency');
Route::get('/deleteCurrency/{currency}','CurrencyController@destroy')->name('deleteCurrency');
Route::put('/updateCurrency/{currency}','CurrencyController@update')->name('updateCurrency');
Route::get('/showCurrency/{currency}','CurrencyController@show')->name('showCurrency');
//Interests Configuration Routes
Route::get('/interests','InterestController@index')->name('interests');
Route::get('/createInterest','InterestController@create')->name('createInterest');
Route::post('/createInterest','InterestController@store')->name('createInterest');
Route::get('/editInterest/{interest}','InterestController@edit')->name('editInterest');
Route::get('/deleteInterest/{interest}','InterestController@destroy')->name('deleteInterest');
Route::put('/updateInterest/{interest}','InterestController@update')->name('updateInterest');
Route::get('/showInterest/{interest}','InterestController@show')->name('showInterest');
//Installments Routes
Route::get('/installments','InstallmentController@index')->name('installments');
Route::get('/createInstallment','InstallmentController@create')->name('createInstallment');
Route::post('/createInstallment','InstallmentController@store')->name('createInstallment');
Route::get('/editInstallment/{installment}','InstallmentController@edit')->name('editInstallment');
Route::get('/deleteInstallment/{installment}','InstallmentController@destroy')->name('deleteInstallment');
Route::put('/updateInstallment/{installment}','InstallmentController@update')->name('updateInstallment');
Route::get('/showInstallment/{installment}','InstallmentController@show')->name('showInstallment');
//Loans Routes
Route::get('/loans','LoanController@index')->name('loans');
Route::get('/createLoan','LoanController@create')->name('createLoan');
Route::post('/createLoan','LoanController@store')->name('createLoan');
Route::get('/editLoan/{loan}','LoanController@edit')->name('editLoan');
Route::get('/deleteLoan/{loan}','LoanController@destroy')->name('deleteLoan');
Route::put('/updateLoan/{loan}','LoanController@update')->name('updateLoan');
Route::get('/showLoan/{loan}','LoanController@show')->name('showLoan');
Route::get('/authorizeLoan/{loan}','LoanController@authorizeLoan')->name('authorizeLoan');
Route::get('/rejectLoan/{loan}','LoanController@rejectLoan')->name('rejectLoan');
//Repayments Frequency Configuration Routes
Route::get('/frequencies','RepaymentController@index')->name('frequencies');
Route::get('/createFrequency','RepaymentController@create')->name('createFrequency');
Route::post('/createFrequency','RepaymentController@store')->name('createFrequency');
Route::get('/editFrequency/{frequency}','RepaymentController@edit')->name('editFrequency');
Route::get('/deleteFrequency/{repayment}','RepaymentController@destroy')->name('deleteFrequency');
Route::put('/updateFrequency/{frequency}','RepaymentController@update')->name('updateFrequency');
Route::get('/showFrequency/{frequency}','RepaymentController@show')->name('showFrequency');
//Loan and Assets Statuses Configuration Routes
Route::get('/statuses','StatusController@index')->name('statuses');
Route::get('/createStatus','StatusController@create')->name('createStatus');
Route::post('/createStatus','StatusController@store')->name('createStatus');
Route::get('/editStatus/{status}','StatusController@edit')->name('editStatus');
Route::get('/deleteStatus/{status}','StatusController@destroy')->name('deleteStatus');
Route::put('/updateStatus/{status}','StatusController@update')->name('updateStatus');
Route::get('/showStatus/{status}','StatusController@show')->name('showStatus');
//Loan Rejections Routes
Route::get('/rejections','RejectController@index')->name('rejections');
Route::get('/unauthorised','RejectController@unauthorised')->name('unauthorised');
Route::get('/myLoans','RejectController@myLoans')->name('myLoans');
Route::get('/editReject/{reject}','RejectController@edit')->name('editReject');
Route::get('/deleteReject/{reject}','RejectController@destroy')->name('deleteReject');
Route::put('/updateReject/{reject}','RejectController@update')->name('updateReject');
Route::get('/showReject/{reject}','RejectController@show')->name('showReject');
//Roles Configuration routes
Route::get('/roles','RejectController@roles')->name('roles');
