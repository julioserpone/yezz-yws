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

/*
 * Routes Groups
 */
//require __DIR__ . '/Routes/landing.php';
Auth::routes();
/*
 * Files Management Routes
 */
Route::get('images/profile/{file}', 'FileController@img')->where('file', '(.*)');
Route::get('documents/{order}/{type}/{file}', 'FileController@showFile')->where('file', '(.*)');

/*
 * Authentication Routes
 */
Route::group([], function () {
	Route::get('logout', 'Auth\LoginController@logout');
});

//Home
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'home'], function () {
    Route::get('/', 'HomeController@index');
});

//Dashboard
Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']);

//Profile
Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
Route::put('profile/update/{id}', ['as' => 'profile.update', 'uses' => 'UserController@update']);

//Register (client ands pdv)
Route::get('register/{language}', ['as' => 'register.user', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('register/customer', ['as' => 'register.new.customer', 'uses' => 'ClientController@registerNewCustomer']);
Route::get('/register/search/countries', ['as' => 'register.search.countries', 'uses' => 'CountryController@search']);
Route::get('/register/search/provinces/{country_id}', ['as' => 'register.search.provinces_by_country', 'uses' => 'ProvinceController@searchByCountry']);
Route::get('/register/search/cities/{country_id}', ['as' => 'register.search.cities_by_province', 'uses' => 'CityController@searchByProvince']);

//Maintenance
Route::group(['roles' => ['admin','analist','manager'], 'middleware' => ['roles']], function ()
{
    Route::resource('user', 'UserController');
    Route::resource('brand', 'BrandController');
    Route::resource('chain', 'ChainController');
    Route::resource('city', 'CityController');
    Route::resource('country', 'CountryController');
    Route::resource('courier', 'CourierController');
    Route::resource('failure', 'FailureController');
    Route::resource('family', 'FamilyController');
    Route::resource('part', 'PartController');
    Route::resource('product', 'ProductController');
    Route::resource('producttype', 'ProductTypeController');
    Route::resource('province', 'ProvinceController');
    Route::resource('route', 'RouteController');
    Route::resource('scale', 'ScaleController');
    Route::resource('color', 'ColorController');
    Route::resource('state', 'StateController');
    Route::resource('technology', 'TechnologyController');
    Route::resource('menu', 'RouteController');
    Route::resource('workshop', 'WorkshopController');

    //Change Status in Models
    Route::get('brand/{id}/delete', ['as' => 'brand.delete', 'uses' => 'BrandController@destroy']);
    Route::get('brand/{id}/condition/{status}', ['as' => 'brand.change_status', 'uses' => 'BrandController@changeStatus']);
    Route::get('family/{id}/delete', ['as' => 'family.delete', 'uses' => 'FamilyController@destroy']);
    Route::get('family/{id}/condition/{status}', ['as' => 'family.change_status', 'uses' => 'FamilyController@changeStatus']);
    Route::get('product/{id}/delete', ['as' => 'product.delete', 'uses' => 'ProductController@destroy']);
    Route::get('product/{id}/condition/{status}', ['as' => 'product.change_states', 'uses' => 'ProductController@changeStates']);
    Route::get('producttype/{id}/delete', ['as' => 'producttype.delete', 'uses' => 'ProductTypeController@destroy']);
    Route::get('producttype/{id}/condition/{status}', ['as' => 'producttype.change_status', 'uses' => 'ProductTypeController@changeStatus']);
    Route::get('scale/{id}/delete', ['as' => 'scale.delete', 'uses' => 'ScaleController@destroy']);
    Route::get('scale/{id}/condition/{status}', ['as' => 'scale.change_status', 'uses' => 'ScaleController@changeStatus']);
    Route::get('technology/{id}/delete', ['as' => 'technology.delete', 'uses' => 'TechnologyController@destroy']);
    Route::get('technology/{id}/condition/{status}', ['as' => 'technology.change_status', 'uses' => 'TechnologyController@changeStatus']);
    Route::get('country/{id}/delete', ['as' => 'country.delete', 'uses' => 'CountryController@destroy']);
    Route::get('country/{id}/condition/{status}', ['as' => 'country.change_status', 'uses' => 'CountryController@changeStatus']);
    Route::get('province/{id}/delete', ['as' => 'province.delete', 'uses' => 'ProvinceController@destroy']);
    Route::get('province/{id}/condition/{status}', ['as' => 'province.change_status', 'uses' => 'ProvinceController@changeStatus']);
    Route::get('city/{id}/delete', ['as' => 'city.delete', 'uses' => 'CityController@destroy']);
    Route::get('city/{id}/condition/{status}', ['as' => 'city.change_status', 'uses' => 'CityController@changeStatus']);
    Route::get('courier/{id}/delete', ['as' => 'courier.delete', 'uses' => 'CourierController@destroy']);
    Route::get('courier/{id}/condition/{status}', ['as' => 'courier.change_status', 'uses' => 'CourierController@changeStatus']);
    Route::get('scale/{id}/delete', ['as' => 'scale.delete', 'uses' => 'ScaleController@destroy']);
    Route::get('scale/{id}/condition/{status}', ['as' => 'scale.change_status', 'uses' => 'ScaleController@changeStatus']);
    Route::get('color/{id}/delete', ['as' => 'color.delete', 'uses' => 'ColorController@destroy']);
    Route::get('color/{id}/condition/{status}', ['as' => 'color.change_status', 'uses' => 'ColorController@changeStatus']);
    Route::get('route/{id}/delete', ['as' => 'route.delete', 'uses' => 'RouteController@destroy']);
    Route::get('route/{id}/condition/{status}', ['as' => 'route.change_status', 'uses' => 'RouteController@changeStatus']);
    Route::get('chain/{id}/delete', ['as' => 'chain.delete', 'uses' => 'ChainController@destroy']);
    Route::get('chain/{id}/condition/{status}', ['as' => 'chain.change_status', 'uses' => 'ChainController@changeStatus']);
    Route::get('state/{id}/delete', ['as' => 'state.delete', 'uses' => 'StateController@destroy']);
    Route::get('state/{id}/condition/{status}', ['as' => 'state.change_status', 'uses' => 'StateController@changeStatus']);
    Route::get('workshop/{id}/delete', ['as' => 'workshop.delete', 'uses' => 'WorkshopController@destroy']);
    Route::get('workshop/{id}/condition/{status}', ['as' => 'workshop.change_status', 'uses' => 'WorkshopController@changeStatus']);
    Route::get('user/{id}/delete', ['as' => 'user.delete', 'uses' => 'UserController@destroy']);
    Route::get('user/{id}/condition/{status}', ['as' => 'user.change_status', 'uses' => 'UserController@changeStatus']);
    Route::get('failure/{id}/delete', ['as' => 'failure.delete', 'uses' => 'FailureController@destroy']);
    Route::get('failure/{id}/condition/{status}', ['as' => 'failure.change_status', 'uses' => 'FailureController@changeStatus']);

    //Sincronize Products (Dinamics GP)
    Route::post('products/sincronize', ['as' => 'products.sincronize', 'uses' => 'ProductController@sincronize']); 
});

//Products and Client Maintenance
Route::group(['roles' => ['admin','callcenter','analist','manager'], 'middleware' => ['roles']], function ()
{
    Route::resource('client', 'ClientController');

    //Change Status in Models
    Route::get('client/{id}/delete', ['as' => 'client.delete', 'uses' => 'ClientController@destroy']);
    Route::get('client/{id}/condition/{status}', ['as' => 'client.change_status', 'uses' => 'ClientController@changeStatus']);
    Route::post('order/{id}/update/management', ['as' => 'order.update_type_management', 'uses' => 'OrderController@updateTypeManagement']);

    //Sincronize products with Dinamics GP
    Route::get('product/sincronize', ['as' => 'product.sincronize', 'uses' => 'ProductController@sincronize']);
});

//Search (public)
Route::group(['prefix' => 'search', 'roles' => ['admin','callcenter','analist','manager','workshop','client','store'], 'middleware' => ['web','roles']], function ()
{
    Route::get('countries', ['as' => 'search.countries', 'uses' => 'CountryController@search']);
    Route::get('provinces', ['as' => 'search.provinces', 'uses' => 'ProvinceController@search']);
    Route::get('cities', ['as' => 'search.cities', 'uses' => 'CityController@search']);
    Route::get('clients', ['as' => 'search.clients', 'uses' => 'ClientController@search']);
    Route::get('colors/public', ['as' => 'search.colors.public', 'uses' => 'ColorController@searchToSelect2Format']);
    Route::get('provinces/{country_id}', ['as' => 'search.provinces_by_country', 'uses' => 'ProvinceController@searchByCountry']);
    Route::get('cities/{country_id}', ['as' => 'search.cities_by_province', 'uses' => 'CityController@searchByProvince']);
    Route::get('workshops/{country_id}', ['as' => 'search.workshops_by_country', 'uses' => 'WorkshopController@searchByCountry']);
});

//Search (Except client and store)
Route::group(['prefix' => 'search', 'roles' => ['admin','callcenter','analist','manager','workshop'], 'middleware' => ['web','roles']], function ()
{
    Route::get('routes', ['as' => 'search.routes', 'uses' => 'RouteController@search']);
    Route::get('couriers', ['as' => 'search.couriers', 'uses' => 'CourierController@search']);
    Route::get('failures', ['as' => 'search.failures', 'uses' => 'FailureController@search']);
    Route::get('products', ['as' => 'search.products', 'uses' => 'ProductController@search']);
    Route::get('producttypes', ['as' => 'search.producttypes', 'uses' => 'ProductTypeController@search']);
    Route::get('brands', ['as' => 'search.brands', 'uses' => 'BrandController@search']);
    Route::get('families', ['as' => 'search.families', 'uses' => 'FamilyController@search']);
    Route::get('technologies', ['as' => 'search.technologies', 'uses' => 'TechnologyController@search']);
    Route::get('scales', ['as' => 'search.scales', 'uses' => 'ScaleController@search']);
    Route::get('colors', ['as' => 'search.colors', 'uses' => 'ColorController@search']);
    Route::get('states', ['as' => 'search.states', 'uses' => 'StateController@search']);
    Route::get('actions/{state}', ['as' => 'search.actions_by_states', 'uses' => 'ActionController@searchByState']);
    Route::get('diagnostics/{state_id}', ['as' => 'search.diagnostics_by_states', 'uses' => 'DiagnosticController@searchByState']);
    Route::post('workshops/byCountries/', ['as' => 'search.workshops_by_countries', 'uses' => 'WorkshopController@searchByCountries']);
});

Route::group(['prefix' => 'order', 'roles' => ['admin','callcenter','analist','manager','workshop','client','store'], 'middleware' => ['roles']], function ()
{
    Route::post('/', ['as' => 'order.store', 'uses' => 'OrderController@store']);
    Route::post('/save', ['as' => 'order.store_external', 'uses' => 'OrderController@store_external']);
    Route::get('create', ['as' => 'order.create', 'uses' => 'OrderController@create']);
    Route::put('/{order}', ['as' => 'order.update', 'uses' => 'OrderController@update']);
    Route::get('/{order}/edit', ['as' => 'order.edit', 'uses' => 'OrderController@edit']);
    //Access data order for all roles (list orders and show order data)
    Route::get('/', ['as' => 'order.index', 'uses' => 'OrderController@index']);
    Route::get('{order}', ['as' => 'order.show', 'uses' => 'OrderController@show']);
});

Route::group(['prefix' => 'order', 'roles' => ['admin','callcenter','analist','manager','workshop'], 'middleware' => ['roles']], function ()
{
    Route::delete('/{order}', ['as' => 'order.destroy', 'uses' => 'OrderController@destroy']);
    Route::get('status/{status}', ['as' => 'order.bystatus', 'uses' => 'OrderController@orderByStatus']);
    Route::get('/{order}/courier', ['as' => 'order.assign_courier', 'uses' => 'OrderController@assignCourier']);
    Route::put('/{order}/courier', ['as' => 'order.save_courier', 'uses' => 'OrderController@saveCourier']);
    Route::get('/{order}/download/{type}/{document}', ['as' => 'order.download_document', 'uses' => 'OrderController@downloadDocument']);
    Route::get('/{order}/attachment/edit', ['as' => 'order.show_form_attachment', 'uses' => 'OrderController@showFormUploadAttachment']);
    Route::put('/{order}/attachment', ['as' => 'order.upload_attachment', 'uses' => 'OrderController@uploadAttachment']);
    Route::post('/received', ['as' => 'order.order_received', 'uses' => 'OrderController@orderReceived']);
    Route::get('/{order}/states/create', ['as' => 'order.show_form_state', 'uses' => 'OrderController@showFormState']);
    Route::put('/{order}/state', ['as' => 'order.save_state', 'uses' => 'OrderController@saveState']);
    Route::get('/{order}/ticket', ['as' => 'order.show_ticket', 'uses' => 'OrderController@showTicket']);
    Route::post('/{order}/delete/state', ['as' => 'order.delete.state', 'uses' => 'OrderController@deleteState']);
    Route::post('/{order}/delete/action', ['as' => 'order.delete.action', 'uses' => 'OrderController@deleteAction']);
    Route::post('/{order}/delete/diagnostic', ['as' => 'order.delete.diagnostic', 'uses' => 'OrderController@deleteDiagnostic']);
});

Route::group(['roles' => ['admin','callcenter','analist','manager','workshop','client','store'], 'middleware' => ['roles']], function ()
{
    Route::get('getDataByImei', ['as' => 'products.getdatabyimei', 'uses' => 'ProductController@getDataByImei']);   
    Route::get('getListProductsDinamicsGP', ['as' => 'products.getlistproductsgp', 'uses' => 'ProductController@getListProductsDinamicsGP']);
    Route::get('receive/equipment/{order}', ['as' => 'order.show_form_equipment_receive', 'uses' => 'OrderController@showFormEquipmentReceive']); 
});

//Email Management
Route::get('email/{status}/{id}', ['as' => 'test.email.issued_case', 'uses' => 'HomeController@ViewEmail']); //TEST
Route::group(['prefix' => 'email', 'roles' => ['admin','callcenter','analist','manager','workshop'], 'middleware' => ['web','roles']], function ()
{
    Route::post('resend/order/{id}', ['as' => 'order.resend', 'uses' => 'OrderController@resendEmailOrderCreated']);
});

/*Reports*/
Route::group(['prefix' => 'report', 'roles' => ['admin','callcenter','analist','manager','workshop'], 'middleware' => ['roles']], function ()
{
    Route::get('/', ['as' => 'report.index', 'uses' => 'ReportController@index']);
    Route::get('/group_items/{report_group_id}', ['as' => 'report.group_items', 'uses' => 'ReportController@groupItems']);
    Route::post('/report_items', ['as' => 'report.save_report_items', 'uses' => 'ReportController@saveReportItems']);
    Route::get('/report_items/{report_id}', ['as' => 'report.report_items', 'uses' => 'ReportController@getReportItems']);
    Route::post('/export', ['as' => 'report.export', 'uses' => 'ReportController@export']);
    Route::get('/items', ['as' => 'report.items', 'uses' => 'ReportController@templateItems']);
    Route::post('/generate', ['as' => 'report.generate', 'uses' => 'ReportController@generate']);
});

//Only for clients and pdv
Route::group(['roles' => ['client','store'], 'middleware' => ['roles']], function ()
{
    Route::get('client/edit/profile', ['as' => 'client.edit.profile', 'uses' => 'ClientController@profileClient']);
    Route::match(['put', 'patch'], 'client/{id}/update', ['as' => 'client.update.profile', 'uses' => 'ClientController@update']);
});