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
Route::middleware(['auth','role:administrator|auditor'])->group( function() {
Route::get('/audits','HomeController@audits')->name('audits');
Route::get('/allInstallments','InstallmentController@allInstallments')->name('allInstallments');

});
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/branches', 'BranchController@index')->name('branches');
    Route::get('/createBranch', 'BranchController@create')->name('createBranch');
    Route::post('/createBranch', 'BranchController@store')->name('createBranch');
    Route::get('/editBranch/{branch}', 'BranchController@edit')->name('editBranch');
    Route::get('/deleteBranch/{branch}', 'BranchController@destroy')->name('deleteBranch');
    Route::put('/updateBranch/{branch}', 'BranchController@update')->name('updateBranch');
});
//Customers Routes
Route::middleware(['auth','role:administrator|inputter|authorizer|auditor'])->group( function() {
    Route::get('/customers', 'CustomerController@index')->name('customers');
    Route::middleware(['auth','role:administrator|inputter'])->group( function() {
        Route::get('/createCustomer', 'CustomerController@create')->name('createCustomer');
        Route::post('/createCustomer', 'CustomerController@store')->name('createCustomer');
        Route::get('/editCustomer/{customer}', 'CustomerController@edit')->name('editCustomer');
        Route::get('/deleteCustomer/{customer}', 'CustomerController@destroy')->name('deleteCustomer');
        Route::put('/updateCustomer/{customer}', 'CustomerController@update')->name('updateCustomer');
    });
    Route::get('/showCustomer/{customer}', 'CustomerController@show')->name('showCustomer');
    Route::get('/showBranchCustomer/{customer}', 'CustomerController@showCustomer')->name('showBranchCustomer');
    Route::get('/branchCustomers', 'CustomerController@branchCustomers')->name('branchCustomers');
});
//Product Line Routes
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/facilities', 'FacilityController@index')->name('facilities');
    Route::get('/createFacility', 'FacilityController@create')->name('createFacility');
    Route::post('/createFacility', 'FacilityController@store')->name('createFacility');
    Route::get('/editFacility/{facility}', 'FacilityController@edit')->name('editFacility');
    Route::get('/deleteFacility/{facility}', 'FacilityController@destroy')->name('deleteFacility');
    Route::put('/updateFacility/{facility}', 'FacilityController@update')->name('updateFacility');
    Route::get('/showFacility/{facility}', 'FacilityController@show')->name('showFacility');
});
//Assets Routes
Route::middleware(['auth','role:administrator|stores_clerk'])->group( function() {
    Route::get('/assets', 'AssetController@index')->name('assets');
    Route::get('/createAsset', 'AssetController@create')->name('createAsset');
    Route::post('/createAsset', 'AssetController@store')->name('createAsset');
    Route::get('/editAsset/{asset}', 'AssetController@edit')->name('editAsset');
    Route::get('/deleteAsset/{asset}', 'AssetController@destroy')->name('deleteAsset');
    Route::put('/updateAsset/{asset}', 'AssetController@update')->name('updateAsset');
    Route::get('/showAsset/{asset}', 'AssetController@show')->name('showAsset');
    Route::post('/importAsset', 'AssetController@import')->name('importAsset');
    Route::get('/importFile', 'AssetController@importFile')->name('importFile');
});
//Currency Configuration Routes
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/currencies', 'CurrencyController@index')->name('currencies');
    Route::get('/createCurrency', 'CurrencyController@create')->name('createCurrency');
    Route::post('/createCurrency', 'CurrencyController@store')->name('createCurrency');
    Route::get('/editCurrency/{currency}', 'CurrencyController@edit')->name('editCurrency');
    Route::get('/deleteCurrency/{currency}', 'CurrencyController@destroy')->name('deleteCurrency');
    Route::put('/updateCurrency/{currency}', 'CurrencyController@update')->name('updateCurrency');
    Route::get('/showCurrency/{currency}', 'CurrencyController@show')->name('showCurrency');
});
//Interests Configuration Routes
Route::middleware(['auth','role:administrator|inputter'])->group( function() {
    Route::get('/interests', 'InterestController@index')->name('interests');
    Route::get('/createInterest', 'InterestController@create')->name('createInterest');
    Route::post('/createInterest', 'InterestController@store')->name('createInterest');
    Route::get('/editInterest/{interest}', 'InterestController@edit')->name('editInterest');
    Route::get('/deleteInterest/{interest}', 'InterestController@destroy')->name('deleteInterest');
    Route::put('/updateInterest/{interest}', 'InterestController@update')->name('updateInterest');
    Route::get('/showInterest/{interest}', 'InterestController@show')->name('showInterest');
});
//Installments Routes
Route::middleware(['auth','role:administrator|inputter|authorizer'])->group( function() {
    Route::get('/installments', 'InstallmentController@index')->name('installments');
    Route::get('/createInstallment', 'InstallmentController@create')->name('createInstallment');
    Route::post('/createInstallment', 'InstallmentController@store')->name('createInstallment');
    Route::get('/editInstallment/{installment}', 'InstallmentController@edit')->name('editInstallment');
    Route::get('/deleteInstallment/{installment}', 'InstallmentController@destroy')->name('deleteInstallment');
    Route::middleware(['auth','role:administrator|authorizer'])->group( function() {
        Route::get('/authorizeInstallment/{installment}', 'InstallmentController@authorizeInstallment')->name('authorizeInstallment');
    });
    Route::get('/showInstallment/{installment}', 'InstallmentController@show')->name('showInstallment');
    Route::get('/returnId', 'InstallmentController@clientId')->name('returnClientId');
});
//Loans Routes
Route::middleware(['auth','role:administrator|inputter|authorizer|auditor'])->group( function() {
    Route::get('/loans', 'LoanController@index')->name('loans');
    Route::middleware(['auth','role:administrator|inputter'])->group( function() {
        Route::get('/createLoan', 'LoanController@create')->name('createLoan');
        Route::post('/createLoan', 'LoanController@store')->name('createLoan');
        Route::get('/editLoan/{loan}', 'LoanController@edit')->name('editLoan');
        Route::get('/deleteLoan/{loan}', 'LoanController@destroy')->name('deleteLoan');
        Route::put('/updateLoan/{loan}', 'LoanController@update')->name('updateLoan');
    });
    Route::get('/showLoan/{loan}', 'LoanController@show')->name('showLoan');
    Route::get('/showAllLoan/{loan}', 'LoanController@showLoan')->name('showAllLoan');
    Route::middleware(['auth','role:administrator|authorizer'])->group( function() {
        Route::get('/authorizeLoan/{loan}', 'LoanController@authorizeLoan')->name('authorizeLoan');
    });
    Route::get('/rejectLoan/{loan}', 'LoanController@rejectLoan')->name('rejectLoan');
});
//Repayments Frequency Configuration Routes
Route::middleware(['auth','role:administrator'])->group( function() {
Route::get('/frequencies','RepaymentController@index')->name('frequencies');
Route::get('/createFrequency','RepaymentController@create')->name('createFrequency');
Route::post('/createFrequency','RepaymentController@store')->name('createFrequency');
Route::get('/editFrequency/{frequency}','RepaymentController@edit')->name('editFrequency');
Route::get('/deleteFrequency/{repayment}','RepaymentController@destroy')->name('deleteFrequency');
Route::put('/updateFrequency/{frequency}','RepaymentController@update')->name('updateFrequency');
Route::get('/showFrequency/{frequency}','RepaymentController@show')->name('showFrequency');
});
//Loan and Assets Statuses Configuration Routes
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/statuses', 'StatusController@index')->name('statuses');
    Route::get('/createStatus', 'StatusController@create')->name('createStatus');
    Route::post('/createStatus', 'StatusController@store')->name('createStatus');
    Route::get('/editStatus/{status}', 'StatusController@edit')->name('editStatus');
    Route::get('/deleteStatus/{status}', 'StatusController@destroy')->name('deleteStatus');
    Route::put('/updateStatus/{status}', 'StatusController@update')->name('updateStatus');
    Route::get('/showStatus/{status}', 'StatusController@show')->name('showStatus');
});
//Loan Rejections Routes
Route::get('/rejections','RejectController@index')->name('rejections');
Route::get('/unauthorised','RejectController@unauthorised')->name('unauthorised');
Route::get('/myLoans','RejectController@myLoans')->name('myLoans');
Route::get('/editReject/{reject}','RejectController@edit')->name('editReject');
Route::get('/deleteReject/{reject}','RejectController@destroy')->name('deleteReject');
Route::put('/updateReject/{reject}','RejectController@update')->name('updateReject');
Route::get('/showReject/{reject}','RejectController@show')->name('showReject');
//Users Configuration routes
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/createUser', 'UserController@create')->name('createUser');
    Route::post('/createUser', 'UserController@store')->name('createUser');
    Route::get('/editUser/{user}', 'UserController@edit')->name('editUser');
    Route::put('/updateUser/{user}', 'UserController@update')->name('updateUser');
    Route::get('/deleteUser/{user}', 'UserController@destroy')->name('deleteUser');
});
//Permissions Configuration routes
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/permissions', 'PermissionController@index')->name('permissions');
    Route::get('/createPermission', 'PermissionController@create')->name('createPermission');
    Route::post('/createPermission', 'PermissionController@store')->name('createPermission');
    Route::get('/deletePermission/{permission}', 'PermissionController@destroy')->name('deletePermission');
});
//Roles Configuration routes
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/roles', 'RoleController@index')->name('roles');
    Route::get('/createRole', 'RoleController@create')->name('createRole');
    Route::post('/createRole', 'RoleController@store')->name('createRole');
    Route::get('/deleteRole/{role}', 'RoleController@destroy')->name('deleteRole');
    Route::get('/showRole/{role}', 'RoleController@show')->name('showRole');
});
//Routes for loan schedules
Route::get('/schedules','LoanScheduleController@index')->name('schedules');
Route::get('/searchLoan','LoanScheduleController@searchLoan')->name('searchLoan');
//Route::get('/maturityReport','LoanScheduleController@maturity')->name('maturityReport');
//Route::get('/searchMaturity','LoanScheduleController@searchMaturity')->name('searchMaturity');
Route::get('/showMaturity/{loan}','LoanScheduleController@showMaturity')->name('showMaturity');
Route::get('/loanMaturity','LoanController@loanMaturity')->name('loanMaturity');
Route::get('/searchLoanMaturity','LoanController@searchLoanMaturity')->name('searchLoanMaturity');
Route::get('/loanStatement','LoanController@loanStatement')->name('loanStatement');
Route::get('/searchLoanStatement','LoanController@searchLoanStatement')->name('searchLoanStatement');

//Routes for guarantee types
Route::middleware(['auth','role:administrator'])->group( function() {
    Route::get('/guaranteeTypes', 'GuaranteeTypeController@index')->name('guaranteeTypes');
    Route::get('/createGuaranteeType', 'GuaranteeTypeController@create')->name('createGuaranteeType');
    Route::post('/createGuaranteeType', 'GuaranteeTypeController@store')->name('createGuaranteeType');
    Route::get('/editGuaranteeType/{guaranteeType}', 'GuaranteeTypeController@edit')->name('editGuaranteeType');
    Route::put('/updateGuaranteeType/{guaranteeType}', 'GuaranteeTypeController@update')->name('updateGuaranteeType');
    Route::get('/deleteGuaranteeType/{guaranteeType}', 'GuaranteeTypeController@destroy')->name('deleteGuaranteeType');
});
//Routes for guarantees
Route::middleware(['auth','role:administrator|inputter|authorizer'])->group( function() {
    Route::get('/guarantees', 'GuaranteeController@index')->name('guarantees');
    Route::get('/createGuarantee', 'GuaranteeController@create')->name('createGuarantee');
    Route::post('/createGuarantee', 'GuaranteeController@store')->name('createGuarantee');
    Route::get('/editGuarantee/{guarantee}', 'GuaranteeController@edit')->name('editGuarantee');
    Route::get('/showGuarantee/{guarantee}', 'GuaranteeController@show')->name('showGuarantee');
    Route::middleware(['auth','role:administrator|authorizer'])->group( function() {
        Route::get('/authorizeGuarantee/{guarantee}', 'GuaranteeController@authorizeGuarantee')->name('authorizeGuarantee');
    });
    Route::put('/updateGuarantee/{guarantee}', 'GuaranteeController@update')->name('updateGuarantee');
    Route::get('/deleteGuarantee/{guarantee}', 'GuaranteeController@destroy')->name('deleteGuarantee');
});
Route::get('/allGuarantees','GuaranteeController@allGuarantees')->name('allGuarantees');
