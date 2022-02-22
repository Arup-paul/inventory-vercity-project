@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
        <small>Update Category</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Category</li>
      </ol>
    </section>




    <div class="content">
        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Update Category  </h3><a href="{{route('categories.view')}}" class="btn btn-primary pull-right">Category List</a>
            </div>



            <!-- /.box-header -->
        <form role="form" action="{{route('categories.update',$data->id)}}" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                      <div class="form-group col-md-6">
                        <label for="id1">Name</label>
                      <input type="text"  name="name" class="form-control" id="id1" value="{{$data->name}}">
                      <font style="color:red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                      </div>


                      <div class="form-group col-md-6">
                        <label for="id3">Status</label>
                        <select class="form-control" name="status" id="3">
                              <option value="">--Select Status--</option>
                              <option value="1" {{($data->status==1)?"selected":""}}>Active</option>
                              <option value="0" {{($data->status==0)?"selected":""}}>Inactive</option>

                        </select>
                        <font style="color:red">{{($errors->has('status'))?($errors->first('status')):''}}</font>
                      </div>


                    </div>

                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                  </form>

            </div>
        </div>
    </div>



  @endsection
