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

//Route::get('/', function () {
//    return view('welcome');
//});

//Auth::routes();

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('landlords/actions', 'LandLordsController@actions');
    Route::get('landlords/reports', 'LandLordsController@reports');
    Route::get('/landlords/actions/new', ['as' => 'new_landlord', 'uses' => 'LandLordsController@newLandlord']);
    Route::post('/landlords/save', ['as' => 'saveLord', 'uses' => 'LandLordsController@saveLandlord']);
    Route::post('/landlords/edit/save', ['as' => 'editLord', 'uses' => 'LandLordsController@editCompleteLandlord']);
    Route::get('/landlord/new_landlord/state/ajax/{country_id}',array('as'=>'new_landlord_state.ajax','uses'=>'LandLordsController@stateForCountryAjax'));
    Route::get('/landlord/new_landlord/city/ajax',array('as'=>'new_landlord_city.ajax','uses'=>'LandLordsController@cityForStateAjax'));
    Route::get('/landlord/reports/show', ['as' => 'show_landlords', 'uses' => 'LandLordsController@showLandlords']);
    Route::get('/landlord/landlords/remove/{landlord_id}', 'LandLordsController@removeLandlord');
    Route::get('/landlord/landlords/edit/{landlord_id}', 'LandLordsController@editLandlord');

    Route::get('/properties/actions', 'PropertiesController@actions');
    Route::get('/properties/reports', 'PropertiesController@reports');
    Route::get('/properties/actions/new', ['as' => 'new_property', 'uses' => 'PropertiesController@newProperty']);
    Route::get('/properties/actions/rent', ['as' => 'rent_property', 'uses' => 'PropertiesController@rentProperty']);
    Route::post('/properties/actions/rentComplete', ['as' => 'rentProperty', 'uses' => 'PropertiesController@rentComplete']);
    Route::post('/properties/save', ['as' => 'saveProperty', 'uses' => 'PropertiesController@saveProperty']);
    Route::get('/properties/rent_property/ajax/{landlord_id}',array('as'=>'rent_property.ajax','uses'=>'PropertiesController@propertyForLandlordAjax'));
    Route::get('/properties/reports/details', ['as' => 'property_details', 'uses' => 'PropertiesController@propertyDetails']);


    Route::get('tenants/actions', 'TenantsController@actions');
    Route::get('tenants/reports', 'TenantsController@reports');
    Route::get('/tenants/actions/new', ['as' => 'new_tenant', 'uses' => 'TenantsController@newTenant']);
    Route::post('/tenants/save', ['as' => 'saveTenant', 'uses' => 'TenantsController@saveTenant']);
    Route::get('/tenants/reports/show', ['as' => 'show_tenants', 'uses' => 'TenantsController@showTenants']);
    Route::get('/tenant/tenants/remove/{tenant_id}', 'TenantsController@removeTenant');
    Route::get('/tenant/tenants/edit/{tenant_id}', 'TenantsController@editTenant');
    Route::post('/tenants/edit/save', ['as' => 'editTenant', 'uses' => 'TenantsController@editCompleteTenant']);

    Route::get('office/entities', 'BackOfficeController@entities');
    Route::get('office/accounting', 'BackOfficeController@accounting');
    Route::get('office/mpesa', 'BackOfficeController@mpesa');
    Route::get('office/financial-reports', 'BackOfficeController@financialReports');
    Route::get('office/other-reports', 'BackOfficeController@otherReports');

    Route::get('system/setup', 'SystemController@setup');
    Route::get('system/other-actions', 'SystemController@otherActions');
    Route::get('system/communication', 'SystemController@communication');
    Route::get('system/reports', 'SystemController@reports');
});


