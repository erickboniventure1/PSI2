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

Auth::routes();

Route::view('/admin/login', 'cms.login')->name('admin_login');

Route::middleware('auth')->prefix('/admin')->group(function() {
// Route::prefix('/admin')->group(function() {
  Route::get('/', 'DashboardController@index')->name('home');
  // Route::get('/', 'FacilityController@charts')->name('chart');
  // Route::get('/', 'IpcLeaderDashboardController@index')->name('ipc');
  Route::resources([
    'regions' => 'RegionController',
    'districts' => 'DistrictController',
    'ipcLeaders' => 'IpcLeaderController',
    'staff' => 'StaffController',
    'facilities' => 'FacilityController',
  ]);
  
  Route::view('/change_password', 'cms.change_password')
       ->name('change_password');
});

Route::prefix('/api')->group(function() {
  
  Route::get('/regions', 'RegionController@regions');
  Route::post('/regions', 'RegionController@store');
  Route::patch('/regions/{region}', 'RegionController@update');
  Route::patch('/regions/{region}/picture', 'RegionController@updatePicture');
  Route::delete('/regions/{region}', 'RegionController@destroy');
  Route::get('/regions/{type}', 'RegionController@downloadExcel');
  Route::post('/regions/upload_excel', 'RegionController@importExcel');


  Route::get('/districts', 'DistrictController@districts');
  Route::post('/districts', 'DistrictController@store');
  Route::patch('/districts/{district}', 'DistrictController@update');
  Route::delete('/districts/{district}', 'DistrictController@destroy');

  Route::get('/staff', 'StaffController@staff');
  Route::post('/staff', 'StaffController@store');
  Route::patch('/staff/{staff}', 'StaffController@update');
  Route::patch('/staff/{staff}/picture', 'StaffController@updatePicture');
  Route::delete('/staff/{staff}', 'StaffController@destroy');
  Route::post('/staff/upload_excel', 'StaffController@importExcel');


  Route::get('/ipcLeaders', 'IpcLeaderController@ipcLeader');
  Route::post('/ipcLeaders', 'IpcLeaderController@store');
  Route::patch('/ipcLeaders/{ipcLeader}', 'IpcLeaderController@update');
  Route::patch('/ipcLeaders/{ipcLeader}/picture', 'IpcLeaderController@updatePicture');
  Route::delete('/ipcLeaders/{ipcLeader}', 'IpcLeaderController@destroy');

  Route::get('/facilities', 'FacilityController@facilities');
  Route::get('/facilities/regions/{region}/districts', 'FacilityController@districts');
  Route::post('/facilities', 'FacilityController@store');
  Route::patch('/facilities/{facility}', 'FacilityController@update');
  Route::patch('/facilities/{facility}/picture', 'FacilityController@updatePicture');
  Route::delete('/facilities/{facility}', 'FacilityController@destroy');
  Route::post('/facilities/upload_excel', 'FacilityController@importExcel');

});
