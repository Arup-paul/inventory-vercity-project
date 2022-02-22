@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <small>Add Product</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Product</li>
      </ol>
    </section>




    <div class="content">
        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Add Product  </h3><a href="{{route('products.view')}}" class="btn btn-primary pull-right">Product List</a>
            </div>



            <!-- /.box-header -->
        <form role="form" action="{{route('products.store')}}" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="row">

                      <div class="form-group col-md-6">
                        <label for="id1">Name</label>
                        <input type="text" value="{{old('name')}}" name="name" class="form-control" id="id1" placeholder="Enter name">
                      <font style="color:red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="id1">Quantity</label>
                        <input type="text" value="{{old('quantity')}}" name="quantity" class="form-control" id="id1" placeholder="Enter quantity">
                      <font style="color:red">{{($errors->has('quantity'))?($errors->first('quantity')):''}}</font>
                      </div>


                      <div class="form-group col-md-6">
                        <label for="id3">Supplier</label>
                        <select class="form-control select2" name="supplier_id" id="3">
                              <option value="">--Select Supplier--</option>
                              @foreach($suppliers as $supplier)
                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                              @endforeach

                        </select>
                        <font style="color:red">{{($errors->has('supplier_id'))?($errors->first('supplier_id')):''}}</font>
                      </div>

                        <div class="form-group col-md-6">
                        <label for="id3">Category</label>
                        <select class="form-control select2" name="category_id" id="3">
                              <option value="">--Select Category--</option>
                              @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach

                        </select>
                        <font style="color:red">{{($errors->has('category_id'))?($errors->first('category_id')):''}}</font>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="id3">Unit</label>
                        <select class="form-control select2" name="unit_id" id="3">
                              <option value="">--Select Unit--</option>
                              @foreach($units as $unit)
                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                              @endforeach

                        </select>
                        <font style="color:red">{{($errors->has('unit_id'))?($errors->first('unit_id')):''}}</font>
                      </div>


                      <div class="form-group col-md-6">
                        <label for="id3">Status</label>
                        <select class="form-control" name="status" id="3">
                              <option value="">--Select Status--</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>

                        </select>
                        <font style="color:red">{{($errors->has('status'))?($errors->first('status')):''}}</font>
                      </div>


                    </div>

                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                  </form>

            </div>
        </div>
    </div>



  @endsection
