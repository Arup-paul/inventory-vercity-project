@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Purchase
        <small>Add Purchase</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Purchase</li>
      </ol>
    </section>

           @if(session()->has('msg'))
           <div class="alert alert-{{session('type')}}">
               {{session('msg')}}
           </div>
       @endif




    <div class="content">
        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Add Purchase  </h3><a href="{{route('purchase.view')}}" class="btn btn-primary pull-right">Purchase List</a>
            </div>



            <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">


                             <div class="form-group col-md-4">
                        <label for="id1">Date</label>
                        <input type="text" placeholder="yyyy-mm-dd" class="form-control form-control-sm datepicker" id="date" name="date" >
                      <font style="color:red">{{($errors->has('date'))?($errors->first('date')):''}}</font>
                      </div>

                      <div class="form-group col-md-4">
                        <label for="id1">Purchase No</label>
                        <input type="text" value="{{old('purchase_no')}}" name="purchase_no" class="form-control form-control-sm" id="purchase_no" placeholder="Enter Purchase No">
                      <font style="color:red">{{($errors->has('purchase_no'))?($errors->first('purchase_no')):''}}</font>
                      </div>


                      <div class="form-group col-md-4">
                        <label for="id3">Supplier</label>
                        <select class="form-control select2" id="supplier_id" name="supplier_id" id="3">
                              <option value="">Select Supplier </option>
                              @foreach($suppliers as $supplier)
                              <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                              @endforeach

                        </select>
                        <font style="color:red">{{($errors->has('supplier_id'))?($errors->first('supplier_id')):''}}</font>
                      </div>

                        <div class="form-group col-md-5">
                        <label for="id3">Category</label>
                        <select class="form-control select2" id="category_id" name="category_id" id="3">

                            <option value="">Select Category</option>

                        </select>
                        <font style="color:red">{{($errors->has('category_id'))?($errors->first('category_id')):''}}</font>
                      </div>

                      <div class="form-group col-md-5">
                        <label for="id3">Product Name</label>
                        <select class="form-control select2" id="product_id" name="product_id" id="3">
                              <option value="">Select Product</option>

                        </select>
                        <font style="color:red">{{($errors->has('product_id'))?($errors->first('product_id')):''}}</font>
                      </div>

                      <div class="form-group col-md-2" style="padding-top: 20px">
                          <a  class="btn btn-sm btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add Item</a>
                      </div>




                    </div>

                    <div class="box-body">
                      <form role="form" action="{{route('purchase.store')}}" method="post">
                    @csrf
                        <table class="table-sm table-bordered" width="100%">
                          <thead>
                            <tr>
                              <th width="20%">Category</th>
                              <th width="20%">Product Name</th>
                              <th>PCS/KG</th>
                              <th>Unit Price</th>
                              <th width="20%">Description</th>
                              <th>Tota Price</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody id="addRow" class="addRow">

                          </tbody>

                           <tbody>
                                <tr>
                                <td colspan="5"></td>
                                <td>
                                  <input type="text" name="estimate_amount" value="0" id="estimate_amount" class="form-control form-control-sm text-right estimate_amount" readonly style="background-color:#D8FDBA">
                                </td>
                                <td></td>
                              </tr>
                          </tbody>
                        </table>
                        <br>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary" id="storeButton">Purchas Store</button>
                        </div>


                      </form>
                    </div>
            </div>
        </div>
    </div>


  @endsection

  @push('js')

  <script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date[]" value="@{{date}}">
    <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
    <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
    <td>
    <input type="hidden" name="category_id[]" value="@{{category_id}}">
    @{{category_name}}
    </td>
    <td>
    <input type="hidden" name="product_id[]" value="@{{product_id}}">
    @{{product_name}}
    </td>
    <td>
    <input type="number" name="buying_qty[]" min="1" value="1" class="form-control form-control-sm text-right buying_qty" value="@{{buying_qty}}">
    </td>
     <td>
    <input type="number" name="unit_price[]"  value="1" class="form-control form-control-sm text-right unit_price" >
    </td>
    <td>
    <input type="text" name="description[]"   class="form-control form-control-sm text-right description" value="">
    </td>
    <td>
    <input type="text" name="buying_price[]"   class="form-control form-control-sm text-right buying_price" value="0" readonly>
    </td>
    <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>
  </script>

  <script type="text/javascript">
   $(document).ready(function(){
       $(document).on("click",".addeventmore",function(){
           var date = $('#date').val();
           var purchase_no = $('#purchase_no').val();
           var supplier_id = $('#supplier_id').val();
           var category_id = $('#category_id').val();
           var category_name = $('#category_id').find('option:selected').text();
           var product_id = $('#product_id').val();
           var product_name = $('#product_id').find('option:selected').text();

           if(date == ''){
               $.notify("Date is required", {globalPosition:'top right',className:'error'});
               return false;
           }

              if(purchase_no == ''){
               $.notify("Purchase No is  required", {globalPosition:'top right',className:'error'});
               return false;
           }

              if(supplier_id == ''){
               $.notify("Supplier name is required", {globalPosition:'top right',className:'error'});
               return false;
           }
             if(category_id == ''){
               $.notify("Category Name is required", {globalPosition:'top right',className:'error'});
               return false;
           }
              if(product_id == ''){
               $.notify("Product is required", {globalPosition:'top right',className:'error'});
               return false;
           }


           var source = $("#document-template").html();
           var template = Handlebars.compile(source);
           var data = {
                  date:date,
                  purchase_no:purchase_no,
                  supplier_id:supplier_id,
                  category_id:category_id,
                  category_name:category_name,
                  product_id:product_id,
                  product_name:product_name
           };
           var html = template(data);
           $("#addRow").append(html);
       });

       $(document).on("click",".removeeventmore",function(event){
           $(this).closest(".delete_add_more_item").remove();
           totalAmountPrice();
       });

       $(document).on('keyup click','.unit_price,.buying_qty',function(){
           var unit_price = $(this).closest("tr").find("input.unit_price").val();
           var qty = $(this).closest("tr").find("input.buying_qty").val();
           var total = unit_price * qty;
           $(this).closest("tr").find("input.buying_price").val(total);
           totalAmountPrice();
       });

       //calculate sum of amount in invoice

       function totalAmountPrice(){
           var sum =0;
           $(".buying_price").each(function(){
               var value = $(this).val();
               if(!isNaN(value) && value.length != 0){
                   sum += parseFloat(value);
               }
           });
           $('#estimate_amount').val(sum);
       }


   });
  </script>

  {{-- category ajax --}}
    <script>
        $(function(){
          $(document).on('change','#supplier_id',function(){
               var supplier_id = $(this).val();
               $.ajax({
                  url:"{{route('get-category')}}",
                  type:"GET",
                  data:{supplier_id:supplier_id},
                  success:function(data){
                     var html = '<option value="">Select Category</option>';
                     $.each(data,function(key,v){
                          html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
                     });
                     $('#category_id').html(html);

                  }
               });
          });
        });
    </script>
  {{-- Product ajax --}}
      <script>
        $(function(){
          $(document).on('change','#category_id',function(){
               var category_id = $(this).val();
               $.ajax({
                  url:"{{route('get-product')}}",
                  type:"GET",
                  data:{category_id:category_id},
                  success:function(data){
                     var html = '<option value="">Select Product</option>';
                     $.each(data,function(key,v){
                          html += '<option value="'+v.id+'">'+v.name+'</option>';
                     });
                     $('#product_id').html(html);

                  }
               });
          });
        });
    </script>
  @endpush



