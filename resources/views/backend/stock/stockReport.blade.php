@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Stock</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stock</li>
      </ol>
    </section>


    <div class="content">

        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Stock Report List   </h3><a href="{{route('stock.report.pdf')}}"  class="btn btn-primary pull-right"><i class="fa fa-download"></i> Download PDF</a>
            </div>

           @if(session()->has('msg'))
           <div class="alert alert-{{session('type')}}">
               {{session('msg')}}
           </div>
       @endif
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example1" class="table table-bordered table-responsive">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Supplier Name</th>
                  <th>Category</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                  @foreach($data as $single_data)

                <tr>
                <td>{{$i++}}</td>
                <td>{{$single_data->supplier->name}}</td>
                <td>{{$single_data->category->name}}</td>
                <td>{{$single_data->name}}</td>
                <td>{{$single_data->quantity}}</td>
                <td>{{$single_data->unit->name}}</td>
                </tr>
                @endforeach







                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

    </div>



  @endsection
