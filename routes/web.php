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
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Account deactivation routes
Route::get('deactivatedAccount', function () {
    return view('deactivatedAccount');
});

//Super admin routes
Route::get('/dashboard', 'super_admin\SuperAdminController@index');
Route::get('userList', 'super_admin\SuperAdminController@userList');

//user process routes
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('profile', 'ProfileController');

//Admin rights routes
Route::get('/adminRights', 'AdminRightsController@index');	
Route::post('/performAdminRights', 'AdminRightsController@performAdminRights');
Route::post('/changeEmployeePswd', 'AdminRightsController@changeEmployeePswd');

//NOC Department Routes
Route::get('/newJobEntry', 'noc\JobController@index');
Route::get('/selectConsumer', 'noc\JobController@selectConsumer');
Route::post('/submitNewJob', 'noc\JobController@newJobEntry');
Route::get('/listOnGoingJobs', 'noc\JobController@onGoingJobs');
Route::post('/closeJob', 'noc\JobController@finishedJob');
Route::get('/listFinishedJobs', 'noc\JobController@listFinishedJobs');
Route::get('/exportFinishedJobs', 'noc\JobController@exportFinishedJobs');
Route::get('/addNewConsumer', 'noc\ConsumerController@index');
Route::get('/setConsumer', 'noc\ConsumerController@setConsumer');
Route::post('/registerNewConsumer', 'noc\ConsumerController@registerNewConsumer');
Route::get('/listConsumer', 'noc\ConsumerController@listConsumer');
Route::post('/transferJob', 'noc\JobController@transferJob');
Route::post('/deleteFinishedJobs', 'noc\JobController@deleteFinishedJobs');
Route::post('/troubleshootJob', 'noc\JobController@troubleshootJob');

//CC Department Routes
Route::get('/downArea', 'cc\DownAreaController@index');
Route::post('/downArea', 'cc\DownAreaController@store');
Route::get('/listDownAreas', 'cc\DownAreaController@listDownAreas');
Route::post('/closeDownArea', 'cc\DownAreaController@closeDownArea');
Route::get('/listClosedDownAreas', 'cc\DownAreaController@listClosedDownAreas');
Route::post('/deleteClosedDownAreas', 'cc\DownAreaController@deleteClosedDownAreas');
Route::get('/exportClosedDownAreas', 'cc\DownAreaController@exportClosedDownAreas');

Route::get('/feasibleArea', 'cc\FeasibleAreaController@index');
Route::post('/feasibleArea', 'cc\FeasibleAreaController@store');
Route::get('/listFeasibleAreas', 'cc\FeasibleAreaController@listFeasibleAreas');
Route::get('/exportFeasibleAreas', 'cc\FeasibleAreaController@exportFeasibleAreas');
Route::post('/deleteFeasibleAreas', 'cc\FeasibleAreaController@deleteFeasibleAreas');
Route::post('/editFeasibleArea', 'cc\FeasibleAreaController@editFeasibleArea');

Route::get('/extension', 'cc\ExtensionController@index');
Route::post('/extension', 'cc\ExtensionController@store');
Route::get('/listExtensions', 'cc\ExtensionController@listExtensions');
Route::post('/operationOnExtensions', 'cc\ExtensionController@operationOnExtensions');
Route::get('/exportExtensions', 'cc\ExtensionController@exportExtensions');
Route::post('/rejectExtension', 'cc\ExtensionController@rejectExtension');

Route::get('/refund', 'cc\RefundController@index');
Route::post('/refund', 'cc\RefundController@store');
Route::get('/listRefunds', 'cc\RefundController@listRefunds');
Route::post('/changeRefundStatus', 'cc\RefundController@changeRefundStatus');
Route::get('/exportRefunds', 'cc\RefundController@exportRefunds');
Route::post('/actOnRefunds', 'cc\RefundController@actOnRefunds');
Route::post('/updateUtr', 'cc\RefundController@updateUtr');
Route::post('/rejectRefund', 'cc\RefundController@rejectRefund');

//HR Department Routes
Route::get('/manPower', 'hr\ManPowerController@index');
Route::post('/manPower', 'hr\ManPowerController@store');
Route::get('/listManPowerRequirments', 'hr\ManPowerController@listManPowerRequirments');
Route::post('/actionOnRequests', 'hr\ManPowerController@actionOnRequests');
Route::post('/editManPowerRequest', 'hr\ManPowerController@editManPowerRequest');
Route::post('/deleteManPowerRequest', 'hr\ManPowerController@deleteManPowerRequest');
Route::get('/exportManPowerRequirments', 'hr\ManPowerController@exportManPowerRequirments');
Route::get('/manPowerRequest/readData/{id}', 'hr\ManPowerController@readData');

Route::get('/stationery', 'hr\StationeryController@index');
Route::post('/stationery', 'hr\StationeryController@store');
Route::get('/listStationeryRequests', 'hr\StationeryController@listStationeryRequests');
Route::post('/actionOnRequests', 'hr\StationeryController@actionOnRequests');
Route::post('/editStationeryRequest', 'hr\StationeryController@editStationeryRequest');
Route::post('/deleteStationeryRequests', 'hr\StationeryController@deleteStationeryRequests');
Route::get('/exportStationeryRequests', 'hr\StationeryController@exportStationeryRequests');

//VOIP 
/*Route::get('/uploadRateSheet', 'voip\RatesController@index');
Route::post('/uploadRateSheet', 'voip\RatesController@updateRateSheet');
Route::get('/addNewCompany', 'voip\RatesController@addNewCompanyForm');
Route::post('/addNewCompany', 'voip\RatesController@storeNewCompany');*/

//Sales
Route::get('/newConnectionForm', 'sales\SalesController@index');
Route::post('/internetLeasedLineConnection', 'sales\SalesController@internetLeasedLinesConnection');
Route::post('/p2pConnection', 'sales\SalesController@p2pConnection');
Route::get('/internetLeasedLine', 'sales\SalesController@internetLeasedLineRequests');
Route::get('/internetLeasedLine/readData/{id}', 'sales\SalesController@readData');
Route::post('/editConnectionRequest', 'sales\SalesController@editConnectionRequest');
Route::post('/fesibilityCheck', 'sales\SalesController@fesibilityCheck');
Route::post('/deleteIllRequests', 'sales\SalesController@deleteIllRequests');

Route::get('/internetLeasedLineFeasibleRequests', 'sales\SalesController@internetLeasedLineFeasibleRequests');
Route::post('/forwardIllRequest', 'sales\SalesController@forwardIllRequest');
Route::get('/illForwardedRequests', 'sales\SalesController@illForwardedRequests');
Route::post('/approveIllRequest', 'sales\SalesController@approveIllRequest');
Route::get('/illRequests', 'sales\SalesController@illRequests');
Route::get('/exportIllRequests', 'sales\SalesController@exportIllRequests');

Route::get('/p2pNewRequests', 'sales\SalesController@p2pNewRequests');
Route::get('/p2pNewRequests/readData/{id}', 'sales\SalesController@readP2pData');
Route::post('/editP2pConnectionRequest', 'sales\SalesController@editP2pConnectionRequest');
Route::post('/p2pFesibilityCheck', 'sales\SalesController@p2pFesibilityCheck');
Route::get('/p2pFeasibleRequests', 'sales\SalesController@p2pFeasibleRequests');
Route::post('/forwardP2pRequest', 'sales\SalesController@forwardP2pRequest');
Route::get('/p2pForwardedRequests', 'sales\SalesController@p2pForwardedRequests');
Route::post('/approveP2pRequest', 'sales\SalesController@approveP2pRequest');
Route::get('/p2pRequests', 'sales\SalesController@p2pRequests');
Route::get('/exportP2pRequests', 'sales\SalesController@exportP2pRequests');

/*//Inventory Department
Route::resource('/inventory', 'inventory\PurchaseRequestController');

//Document Approval 
Route::resource('/documentApproval', 'document_approval\DocumentApprovalController');*/


//Default password generator
Route::get('/pswd', function(){
	return Hash::make('123456');
});

