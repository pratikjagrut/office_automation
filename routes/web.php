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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('profile', 'ProfileController');

//NOC Department Routes

Route::get('/adminRights', 'noc\AdminRightsController@index');	

Route::get('/performAdminRights', 'noc\AdminRightsController@performAdminRights');

//Route::get('/grantAdminRights', 'noc\AdminRightsController@grantAdminRights');

//Route::get('/removeAdminRights', 'noc\AdminRightsController@removeAdminRights');

//Route::get('/deleteAccount', 'noc\AdminRightsController@deleteAccount');

//Route::get('/assignJob', 'noc\AdminRightsController@assignJob');

Route::get('/newJobEntry', 'noc\JobController@index');

Route::get('/selectConsumer', 'noc\JobController@selectConsumer');

Route::post('/submitNewJob', 'noc\JobController@newJobEntry');

Route::get('/listOnGoingJobs', 'noc\JobController@onGoingJobs');

Route::get('/closeJob', 'noc\JobController@finishedJob');

Route::get('/listFinishedJobs', 'noc\JobController@listFinishedJobs');

Route::get('/exportFinishedJobs', 'noc\JobController@exportFinishedJobs');

Route::get('/addNewConsumer', 'noc\ConsumerController@index');

Route::get('/setConsumer', 'noc\ConsumerController@setConsumer');

Route::post('/registerNewConsumer', 'noc\ConsumerController@registerNewConsumer');

Route::get('/listConsumer', 'noc\ConsumerController@listConsumer');



//CC Department Routes
Route::get('/extension', function () {
    return view('customer_care.extension');
});

Route::get('/downArea', function () {
    return view('customer_care.downArea');
});

Route::get('/refund', function () {
    return view('customer_care.refund');
});

Route::get('/feasible', function () {
    return view('customer_care.feasibleArea');
});

Route::resource('extension', 'cc\ExtensionController');
Route::resource('downArea', 'cc\DownAreaController');
Route::resource('feasibleArea', 'cc\FeasibleAreaController.php');
Route::resource('refund', 'cc\RefundController');

//HR Department Routes
Route::get('/manpower', function () {
    return view('hr.manPower');
});

Route::resource('stationery', 'hr\StationeryController');
Route::resource('manPower', 'hr\ManPowerController');


//Sales Department
Route::get('/ill', function () {
    return view('sales.internetLeasedLines');
});

Route::get('/p2p', function () {
    return view('sales.p2p');
});

Route::get('/approvalnote', function () {
    return view('sales.approvalNote');
});

//VOIP Department
Route::get('/voip', function () {
    return view('voip.voipForm');
});


//Default password generator
Route::get('/pswd', function(){
	return Hash::make('123456');
});

