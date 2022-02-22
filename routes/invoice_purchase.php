<?php

//invoice controller route
Route::group( ['prefix' => 'invoice'], function () {
    Route::get( '/view', 'InvoiceController@view' )->name( 'invoice.view' );
    Route::get( '/add', 'InvoiceController@add' )->name( 'invoice.add' );
    Route::get( '/pending', 'InvoiceController@pendingList' )->name( 'invoice.pending' );
    Route::post( '/store', 'InvoiceController@store' )->name( 'invoice.store' );
    Route::get( '/delete/{id}', 'InvoiceController@delete' )->name( 'invoice.delete' );
    Route::get( '/approve/{id}', 'InvoiceController@approve' )->name( 'invoice.approve' );
    Route::post( '/approval/store//{id}', 'InvoiceController@InvoiceApprovalStore' )->name( 'invoice.approval.store' );
    Route::get( '/print/list', 'InvoiceController@printInvoiceList' )->name( 'invoice.print.list' );
    Route::get( '/invoice/print/{id}', 'InvoiceController@printInvoice' )->name( 'invoice.print' );
    Route::get( '/invoice/daily/report', 'InvoiceController@DailyInvoiceReport' )->name( 'invoice.daily.report' );
    Route::get( '/invoice/daily/pdf', 'InvoiceController@DailyInvoiceReportPDF' )->name( 'daily.invoice.report.pdf' );
} );

Route::get( '/check-product-stock', 'DefaultController@checkProductStock' )->name( 'check-product-stock' );




//purchas controller
Route::group( ['prefix' => 'purchase'], function () {
    Route::get( '/view', 'PurchasesController@view' )->name( 'purchase.view' );
    Route::get( '/add', 'PurchasesController@add' )->name( 'purchase.add' );
    Route::get( '/pending', 'PurchasesController@pendingList' )->name( 'purchase.pending' );
    Route::post( '/store', 'PurchasesController@store' )->name( 'purchase.store' );
    Route::get( '/delete/{id}', 'PurchasesController@delete' )->name( 'purchase.delete' );
    Route::get( '/approve/{id}', 'PurchasesController@approve' )->name( 'purchase.approve' );
} );

Route::get( '/get-category', 'DefaultController@getCategory' )->name( 'get-category' );
Route::get( '/get-product', 'DefaultController@getProduct' )->name( 'get-product' );





?>
