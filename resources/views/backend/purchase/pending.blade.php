@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pending Purchase  List
        <small>View Purchase</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Purchase </li>
      </ol>
    </section>


    <div class="content">

        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Pending Purchase List   </h3>
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
                  <th>Purchase No</th>
                  <th>Date</th>
                  <th>Supplier Name</th>
                  <th>Category</th>
                  <th>Product Name</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $key => $single_data)

                <tr>
                <td>{{$key+1}}</td>
                <td>{{$single_data->purchase_no}}</td>
                <td>{{date('d-m-Y',strtotime($single_data->date))}}</td>
                <td>{{$single_data->supplier->name}}</td>
                <td>{{$single_data->category->name}}</td>
                <td>{{$single_data->product->name}}</td>
                <td>{{$single_data->description}}</td>
                <td>
                    {{$single_data->buying_qty}}
                    {{$single_data->product->unit->name}}
                </td>
                <td>{{$single_data->unit_price}}</td>
                <td>{{$single_data->buying_price}}</td>

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
                     <a href="{{route('purchase.approve',$single_data->id)}}" id="approved" onclick="alert('Are you sure want to purchase approved')" title="Approved" class="btn btn-success"><i class="fa fa-check-circle"></i></a>
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
