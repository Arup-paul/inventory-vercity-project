@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>View Invoice</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>


    <div class="content">

        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Invoice No #{{$invoice->invoice_no}}({{date('d-m-Y',strtotime($invoice->date))}})   </h3><a href="{{route('invoice.pending')}}" class="btn btn-primary pull-right"><i class="fa fa-list"></i> Pending Invoice List</a>
            </div>

           @if(session()->has('msg'))
           <div class="alert alert-{{session('type')}}">
               {{session('msg')}}
           </div>
       @endif
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                @php
                 $payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();

                @endphp
              <table width="100%" class="table table-bordered">
                  <tbody>
                      <tr>
                          <td width="15%"><p><strong> Customer Info</strong></p></td>
                          <td width="25%"><p><strong>Name: </strong>  {{$payment->customer->name}}</p></td>
                          <td width="25%"><p><strong>Mobile No: </strong>  {{$payment->customer->mobile_no}}</p></td>
                          <td width="35%"><p><strong>Address: </strong> {{$payment->customer->address}}</p></td>
                      </tr>
                      <tr>
                        <td width="15%"><strong>Description: </strong></td>
                        <td width="85%">{{$invoice->description}}</td>
                      </tr>
                  </tbody>
              </table>
            <form action="{{route('invoice.approval.store',$invoice->id)}}" method="post">
                @csrf
               <table width="100%" class="table table-bordered" border="1" style="margin-bottom:10px">
                  <thead>
                      
                      <tr class="text-center">
                        <th>SL</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th class="text-center" style="background: #ddd;padding:1px;">Current Stock</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                      </tr>
                   
                  </thead>
                  <tbody>
                      @php
                         $total_sum = '0'; 
                      @endphp
                      @foreach($invoice['invoice_details'] as $key=> $details)
                    <tr class="text-center">
                    <input type="hidden" name="category_id[]" value="{{$details->category_id}}">
                    <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                    <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                    <td>{{$key+1}}</td>
                    <td>{{$details->category->name}}</td>
                      <td>{{$details->product->name}}</td>
                      <td class="text-center" style="background: #ddd;padding:1px;">{{$details->product->quantity}}</td>
                      <td>{{$details->selling_qty}}</td>
                      <td>{{$details->unit_price}}</td>
                      <td>{{$details->selling_price}}</td>
                    </tr>
                    @php
                      $total_sum += $details->selling_price;  
                    @endphp

                       @endforeach
                       <tr>
                           <td colspan="6" class="text-right">Sub Total:</td>
                           <td class="text-center"><strong>{{$total_sum}}</strong></td>
                       </tr>
                        <tr>
                           <td colspan="6" class="text-right">Discount</td>
                           <td class="text-center"><strong>{{$payment->discount_amount}}</strong></td>
                       </tr>
                        <tr>
                           <td colspan="6" class="text-right">Paid Amount:</td>
                           <td class="text-center"><strong>{{$payment->paid_amount}}</strong></td>
                       </tr>
                       <tr>
                           <td colspan="6" class="text-right">Due Amount:</td>
                           <td class="text-center"><strong>{{$payment->due_amount}}</strong></td>
                       </tr>
                        <tr>
                           <td colspan="6" class="text-right">Grand Total:</td>
                           <td class="text-center"><strong>{{$payment->total_amount}}</strong></td>
                       </tr>
                       
                  </tbody>

               </table>
               <button class="btn btn-success" type="submit">Invoice Approve</button>
               </form>

            </div>
            <!-- /.box-body -->
          </div>

    </div>



  @endsection
