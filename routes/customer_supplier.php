<?php

//customer route
Route::group( ['prefix' => 'customers'], function () {
    Route::get( '/view', 'CustomersController@view' )->name( 'customers.view' );
    Route::get( '/add', 'CustomersController@add' )->name( 'customers.add' );
    Route::post( '/store', 'CustomersController@store' )->name( 'customers.store' );
    Route::get( '/edit/{id}', 'CustomersController@edit' )->name( 'customers.edit' );
    Route::post( '/update/{id}', 'CustomersController@update' )->name( 'customers.update' );
    Route::get( '/delete/{id}', 'CustomersController@delete' )->name( 'customers.delete' );
} );


//suppliers route
Route::prefix( 'suppliers' )->group( function () {
    Route::get( '/view', 'SupplierController@view' )->name( 'suppliers.view' );
    Route::get( '/add', 'SupplierController@add' )->name( 'suppliers.add' );
    Route::post( '/store', 'SupplierController@store' )->name( 'suppliers.store' );
    Route::get( '/edit/{id}', 'SupplierController@edit' )->name( 'suppliers.edit' );
    Route::post( '/update/{id}', 'SupplierController@update' )->name( 'suppliers.update' );
    Route::get( '/delete/{id}', 'SupplierController@delete' )->name( 'suppliers.delete' );
} );

?>
