<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Customers;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\Payment;
use App\Model\PaymentDetail;
use App\Model\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class InvoiceController extends Controller {
    public function view() {
        $data         = [];
        $data['data'] = Invoice::orderBy( 'date', 'desc' )->orderBy( 'id', 'desc' )->get();

        return view( 'backend.invoice.index', $data );
    }

    public function add() {
        $data               = [];
        $data['categories'] = Category::all();
        $data['customers']  = Customers::all();
        $invoice_data       = Invoice::orderBy( 'id', 'desc' )->first();
        if ( $invoice_data == null ) {
            $firstReg           = '0';
            $data['invoice_no'] = $firstReg + 1;
        } else {
            $invoice_data       = Invoice::orderBy( 'id', 'desc' )->first()->invoice_no;
            $data['invoice_no'] = $invoice_data + 1;
        }
        $data['date'] = date( 'Y-m-d' );
        return view( 'backend.invoice.create', $data );
    }

    public function store( Request $request ) {
        if ( $request->category_id == null ) {
            session()->flash( 'type', 'danger' );
            session()->flash( 'msg', 'Sorry! you Do not select any item' );
            return redirect()->back();
        } else {
            if ( $request->paid_amount > $request->estimate_amount ) {
                session()->flash( 'type', 'danger' );
                session()->flash( 'msg', 'Sorry! paid amount is maximum than total price' );
                return redirect()->back();
            } else {
                $invoice              = new Invoice();
                $invoice->invoice_no  = $request->invoice_no;
                $invoice->date        = date( 'Y-m-d', strtotime( $request->date ) );
                $invoice->description = $request->description;
                $invoice->status      = '0';
                $invoice->created_by  = Auth::user()->id;

                DB::transaction( function () use ( $request, $invoice ) {
                    if ( $invoice->save() ) {
                        $count_category = count( $request->category_id );
                        for ( $i = 0; $i < $count_category; $i++ ) {
                            $invoice_details                = new InvoiceDetail();
                            $invoice_details->date          = $request->date;
                            $invoice_details->invoice_id    = $invoice->id;
                            $invoice_details->category_id   = $request->category_id[$i];
                            $invoice_details->product_id    = $request->product_id[$i];
                            $invoice_details->selling_qty   = $request->selling_qty[$i];
                            $invoice_details->unit_price    = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status        = '1';
                            $invoice_details->save();
                        }
                        if ( $request->customer_id == '0' ) {
                            $customer            = new Customers();
                            $customer->name      = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->email     = $request->email;
                            $customer->address   = $request->address;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else {
                            $customer_id = $request->customer_id;
                        }

                        $payment                  = new Payment();
                        $payment_details          = new PaymentDetail();
                        $payment->invoice_id      = $invoice->id;
                        $payment->customer_id     = $customer_id;
                        $payment->paid_status     = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount    = $request->estimate_amount;

                        if ( $request->paid_status == 'full_paid' ) {
                            $payment->paid_amount                 = $request->estimate_amount;
                            $payment->due_amount                  = '0';
                            $payment_details->current_paid_amount = $request->estimate_amount;
                        } elseif ( $request->paid_status == 'full_due' ) {
                            $payment->paid_amount                 = '0';
                            $payment->due_amount                  = $request->estimate_amount;
                            $payment_details->current_paid_amount = $request->estimate_amount;
                        } elseif ( $request->paid_status == 'partial_paid' ) {
                            $payment->paid_amount                 = $request->paid_amount;
                            $payment->due_amount                  = $request->estimate_amount;
                            $payment_details->current_paid_amount = $request->estimate_amount;
                        }
                        $payment->save();
                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date       = date( 'Y-m-d', strtotime( $request->date ) );
                        $payment_details->save();
                    }
                } );

            }
        }

        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Invoice created successfully!' );
        return redirect( route( 'invoice.view' ) );

    }

    public function pendingList() {
        $data         = [];
        $data['data'] = Invoice::orderBy( 'date', 'desc' )->orderBy( 'id', 'desc' )->where( 'status', 0 )->get();

        return view( 'backend.invoice.pending', $data );
    }

    public function delete( $id ) {
        $invoice = Invoice::find( $id );
        $invoice->delete();
        InvoiceDetail::where( 'invoice_id', $invoice->id )->delete();
        Payment::where( 'invoice_id', $invoice->id )->delete();
        PaymentDetail::where( 'invoice_id', $invoice->id )->delete();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Invoice Deleted' );
        return redirect()->back();
    }

    public function approve( $id ) {
        $data            = [];
        $data['invoice'] = Invoice::with( 'invoice_details' )->find( $id );
        return view( 'backend.invoice.approve', $data );
    }

    public function InvoiceApprovalStore( Request $request, $id ) {
        foreach ( $request->selling_qty as $key => $val ) {
            $invoice_details = InvoiceDetail::where( 'id', $key )->first();
            $product         = Product::where( 'id', $invoice_details->product_id )->first();
            if ( $product->quantity < $request->selling_qty[$key] ) {
                session()->flash( 'type', 'danger' );
                session()->flash( 'msg', 'Sorry! You approve maximum value' );
                return redirect()->back();
            }
        }

        $invoice             = Invoice::find( $id );
        $invoice->approve_by = Auth::user()->id;
        $invoice->status     = '1';

        DB::transaction( function () use ( $request, $invoice, $id ) {
            foreach ( $request->selling_qty as $key => $val ) {
                $invoice_details         = InvoiceDetail::where( 'id', $key )->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product           = Product::where( 'id', $invoice_details->product_id )->first();
                $product->quantity = ( (float) $product->quantity ) - ( (float) $request->selling_qty[$key] );
                $product->save();
            }
            $invoice->save();
        } );
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Invoice Successfully Approved' );
        return redirect()->route( 'invoice.pending' );

    }

    public function printInvoiceList() {
        $data         = [];
        $data['data'] = Invoice::orderBy( 'date', 'desc' )->orderBy( 'id', 'desc' )->get();

        return view( 'backend.invoice.posInvoice_list', $data );
    }

    public function printInvoice( $id ) {
        $data['invoice'] = Invoice::with( 'invoice_details' )->find( $id );
        $pdf             = PDF::loadView( 'backend.pdf.invoice-pdf', $data );
        $pdf->SetProtection( ['copy', 'print'], '', 'pass' );
        return $pdf->stream( 'invoice.pdf' );
    }

    public function DailyInvoiceReport() {
        return view( 'backend.invoice.dailyInvoiceReport' );
    }

    public function DailyInvoiceReportPDF( Request $request ) {
        $this->validate( $request, [
            'start_date' => 'required',
            'end_date' => 'required',
        ] );

        $start_date = date( 'Y-m-d', strtotime( $request->start_date ) );
        $end_date  = date( 'Y-m-d', strtotime( $request->end_date ) );

         $data['data'] = Invoice::whereBetween( 'date', [$start_date, $end_date] )->where( 'status', 1 )->get();
          
        $data['start_date'] = date( 'Y-m-d', strtotime( $request->start_date ) );
        $data['end_date']   = date( 'Y-m-d', strtotime( $request->end_date ) );
        $pdf          = PDF::loadView( 'backend.pdf.DailyInvoiceReportPdf', $data );
        $pdf->SetProtection( ['copy', 'print'], '', 'pass' );
        return $pdf->stream( 'daily_invoice_report.pdf' );
    }
}
