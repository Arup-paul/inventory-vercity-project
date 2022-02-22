@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <small>View Product</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
      </ol>
    </section>


    <div class="content">

        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Product List   </h3><a href="{{route('products.add')}}" class="btn btn-primary pull-right">Add Product</a>
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
                  <th>Unit</th>
                  <th>Quantity</th>
                  <th>Action</th>
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
                <td>{{$single_data->unit->name}}</td>
                <td>{{$single_data->quantity}}</td>
                <td>
                   @if($single_data->status == 1)
                   <span class="badge btn-success">Active</span>
                   @elseif($single_data->status == 0)
                   <span class="badge btn-danger">InActive</span>
                   @endif
               </td>
                <td>
                <a href="{{route('products.edit',$single_data->id)}}" title="Edit" class="btn btn-info"><i class="fa fa-edit"></i></a>
                   <a href="{{route('products.delete',$single_data->id)}}" id="delete" title="Delete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
