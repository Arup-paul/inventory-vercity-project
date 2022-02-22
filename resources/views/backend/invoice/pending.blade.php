@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pending Invoice List
        <small>View Invoice</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pending List</li>
      </ol>
    </section>


    <div class="content">

        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Pending Invoice List   </h3>
            </div>

           @if(session()->has('msg'))
           <div class="alert alert-{{session('type')}}">
               {{session('msg')}}
           </div>
       @endif
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Customer Name</th>
                  <th>Invoice No</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $key => $single_data)

                <tr>
                <td>{{$key+1}}</td>
                 <td>
                     {{$single_data['payment']['customer']['name']}}
                     ({{$single_data['payment']['customer']['mobile_no']}}-{{$single_data['payment']['customer']['address']}})
                    </td>
                <td>#{{$single_data->invoice_no}}</td>
               
                <td>{{date('Y-m-d',strtotime($single_data->date))}}</td>
                <td>{{$single_data->description}}</td>
                <td>BDT {{$single_data->payment->total_amount}}</td>
                 <td>
                   @if($single_data->status == 1)
                   <span class="badge btn-success">Approved</span>
                   @elseif($single_data->status == 0)
                    <span class="badge btn-danger">Pending</span>
                   @endif
                
                </td>
              
                <td>
                   @if($single_data->status == 1)
                   @elseif($single_data->status == 0)
                     <a href="{{route('invoice.approve',$single_data->id)}}"onclick="alert('Are you sure want to Invoice approved')" title="Approved" class="btn btn-success"><i class="fa fa-check-circle"></i></a>
                      <a href="{{route('invoice.delete',$single_data->id)}}" onclick="alert('Are you sure want to Invoice Delete')" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                   @endif
                
                </td>


                </tr>
                @endforeach







                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

    </div>



  @endsection
