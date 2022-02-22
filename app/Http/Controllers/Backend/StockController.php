<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Product;
use PDF;

class StockController extends Controller {
    public function stockReport() {
        $data['data'] = Product::orderBy( 'supplier_id', 'asc' )->orderBy( 'category_id', 'asc' )->get();
        return view( 'backend.stock.stockReport', $data );
    }

    public function stockReportPDF() {
        $data['data'] = Product::orderBy( 'supplier_id', 'asc' )->orderBy( 'category_id', 'asc' )->get();
        $pdf = PDF::loadView( 'backend.pdf.stockReportPdf', $data );
        $pdf->SetProtection( ['copy', 'print'], '', 'pass' );
        return $pdf->stream( 'stock_report.pdf' );
    }
}
