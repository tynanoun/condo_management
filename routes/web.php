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

Route::get('/', function () {
//    return view('login');
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('user')->group(function() {
    Route::get('/delete/{id}', array('as' => 'delete', 'uses' => 'UserController@delete'));
    Route::get('/create/{isStaff}', array('as' => 'create', 'uses' => 'UserController@create'));
    Route::get('/edit/{id}/{isStaff}', array('as' => 'edit', 'uses' => 'UserController@edit'));
    Route::get('/{isStaff}', array('as' => 'index', 'uses' => 'UserController@index'));
    Route::get('/deleteConfirm/{id}', array('as' => 'deleteConfirm', 'uses' => 'UserController@deleteConfirm'));
    Route::get('/customerprofile/{id}/{isStaff}', array('as' => 'customerProfile', 'uses' => 'UserController@getCustomerProfile'));

});

Route::prefix('invoice')->group(function() {
    Route::post('/view',array('as'=>'view','uses'=>'InvoiceController@view'));
    Route::get('/download/{id}/{invoiceType}',array('as'=>'download','uses'=>'InvoiceController@download'));
    Route::get('/send/{id}',array('as'=>'send','uses'=>'InvoiceController@send'));
    Route::post('/savecomment',array('as'=>'saveComment','uses'=>'InvoiceController@saveComment'));
    Route::get('/displaypaymentdialog/{id}',array('as'=>'displaypaymentdialog','uses'=>'InvoiceController@displayPaymentDialog'));
    Route::get('/displayinvoicedialog/{id}',array('as'=>'displayinvoicedialog','uses'=>'InvoiceController@displayInvoiceDialog'));
    Route::post('/paid',array('as'=>'paid','uses'=>'InvoiceController@paid'));
    Route::get('/displayindividualinvoice/{id}/{usageType}',array('as'=>'displayindividualinvoice','uses'=>'InvoiceController@displayIndividualInvoice'));
    Route::get('/downloadinvoicebyusagetype/{id}/{usageType}',array('as'=>'downloadinvoicebyusagetype','uses'=>'InvoiceController@downloadInvoiceByUsageType'));
    Route::get('/paidinvoicebyusagetype/{id}/{usageType}',array('as'=>'paidinvoicebyusagetype','uses'=>'InvoiceController@paidInvoiceByUsageType'));

});

Route::group(['prefix' => 'payment', 'middleware' => ['role:admin']], function() {
    Route::get('/displaypaymentdialog/{id}',array('as'=>'displaypaymentdialog','uses'=>'InvoiceController@displayPaymentDialog'));
    Route::get('/displayinvoicedialog/{id}',array('as'=>'displayinvoicedialog','uses'=>'InvoiceController@displayInvoiceDialog'));
    Route::post('/paid',array('as'=>'paid','uses'=>'InvoiceController@paid'));
});

Route::prefix('usage')->group(function() {
    Route::get('/outstandings', array('as' => 'pdfview', 'uses' => 'UsageController@getOutStandingList'));
    Route::get('/invoice/{id}', array('as' => 'invoice', 'uses' => 'UsageController@sendingInvoice'));
    Route::get('/setpaid/{id}', array('as' => 'setpaid', 'uses' => 'UsageController@setPaid'));
    Route::get('/reports', array('as' => 'reports', 'uses' => 'UsageController@getReports'));
    Route::get('/lease', array('as' => 'lease', 'uses' => 'UsageController@getCurrentRoom'));
    Route::resource('/', 'UsageController');
});

Route::group(['prefix' => 'room', 'middleware' => ['role:admin']], function() {
    Route::get('/delete/{id}', array('as' => 'delete', 'uses' => 'RoomController@delete'));
    Route::get('/deleteConfirm/{id}', array('as' => 'delete', 'uses' => 'RoomController@deleteConfirm'));
});

Route::group(['prefix' => 'contract', 'middleware' => ['role:admin']], function() {
    Route::get('/view/{roomId}', array('as' => 'view', 'uses' => 'ContractController@view'));
    Route::get('/download/{roomId}', array('as' => 'view', 'uses' => 'ContractController@download'));
});

Route::resource('room', 'RoomController');

Route::resource('pricesetting', 'PriceSettingController');

Route::resource('mobile', 'MobileController');

Route::resource('role', 'RoleController');

Route::resource('permission', 'PermissionController');

Route::resource('user', 'UserController');
Route::resource('building', 'BuildingController');
Route::resource('maintenances', 'MaintenancesController');
Route::resource('lease', 'LeaseController');
Route::resource('leasesetting', 'LeaseSettingController');
Route::resource('check', 'CheckController');