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


Route::get('/','Frontend\FrontendController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'namespace' => 'Backend'],function(){


//users controller
Route::prefix('users')->group(function(){
    Route::get('/view','UserController@view')->name('users.view');
    Route::get('/add','UserController@add')->name('users.add');
    Route::post('/store','UserController@store')->name('users.store');
    Route::get('/edit/{id}','UserController@edit')->name('users.edit');
    Route::post('/update/{id}','UserController@update')->name('users.update');
    Route::get('/delete/{id}','UserController@delete')->name('users.delete');
});

//profiles controller
Route::prefix('profiles')->group(function(){
    Route::get('/view','ProfileController@view')->name('profiles.view');
    Route::get('/edit','ProfileController@edit')->name('profiles.edit');
    Route::post('/update','ProfileController@update')->name('profiles.update');
    Route::get('/password/view','ProfileController@passwordView')->name('password.view');
    Route::post('/password/new/update','ProfileController@passwordStore')->name('password.new.store');
});



//customer & supplier controller

@include('customer_supplier.php');

//units controller
Route::group( ['prefix' => 'units'], function () {
    Route::get( '/view', 'UnitsController@view' )->name( 'units.view' );
    Route::get( '/add', 'UnitsController@add' )->name( 'units.add' );
    Route::post( '/store', 'UnitsController@store' )->name( 'units.store' );
    Route::get( '/edit/{id}', 'UnitsController@edit' )->name( 'units.edit' );
    Route::post( '/update/{id}', 'UnitsController@update' )->name( 'units.update' );
    Route::get( '/delete/{id}', 'UnitsController@delete' )->name( 'units.delete' );
} );

//category controller
Route::group( ['prefix' => 'categories'], function () {
    Route::get( '/view', 'CategoryController@view' )->name( 'categories.view' );
    Route::get( '/add', 'CategoryController@add' )->name( 'categories.add' );
    Route::post( '/store', 'CategoryController@store' )->name( 'categories.store' );
    Route::get( '/edit/{id}', 'CategoryController@edit' )->name( 'categories.edit' );
    Route::post( '/update/{id}', 'CategoryController@update' )->name( 'categories.update' );
    Route::get( '/delete/{id}', 'CategoryController@delete' )->name( 'categories.delete' );
} );


//product controller
Route::group( ['prefix' => 'products'], function () {
    Route::get( '/view', 'ProductController@view' )->name( 'products.view' );
    Route::get( '/add', 'ProductController@add' )->name( 'products.add' );
    Route::post( '/store', 'ProductController@store' )->name( 'products.store' );
    Route::get( '/edit/{id}', 'ProductController@edit' )->name( 'products.edit' );
    Route::post( '/update/{id}', 'ProductController@update' )->name( 'products.update' );
    Route::get( '/delete/{id}', 'ProductController@delete' )->name( 'products.delete' );
} );

//stock controller
Route::group( ['prefix' => 'stock'], function () {
    Route::get( '/report', 'StockController@stockReport' )->name( 'stock.report' );
    Route::get( '/report/pdf', 'StockController@stockReportPDF' )->name( 'stock.report.pdf' );
} );



//invoice and purrchase controller route
@include('invoice_purchase.php');








});
