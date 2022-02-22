@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>Add Invoice</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Invoice</li>
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
            <h3 class="box-title">Add Invoice  </h3><a href="{{route('invoice.view')}}" class="btn btn-primary pull-right">Invoice List</a>
            </div>



            <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">

                             <div class="form-group col-md-2">
                        <label for="id1">Invoice No</label>
                        <input type="text" value="{{$invoice_no}}" name="invoice_no" class="form-control form-control-sm"  id="invoice_no" readonly style="background-color:#D8FDBA">
                      <font style="color:red">{{($errors->has('invoice_no'))?($errors->first('invoice_no')):''}}</font>
                      </div>


                             <div class="form-group col-md-2">
                        <label for="id1">Date</ label>
                        <input type="text" value="{{$date}}" class="form-control form-control-sm datepicker" id="date" name="date" >
                      <font style="color:red">{{($errors->has('date'))?($errors->first('date')):''}}</font>
                      </div>

                      



                        <div class="form-group col-md-3">
                        <label for="id3">Category</label>
                        <select class="form-control select2" id="category_id" name="category_id" id="3">
                          
                            <option value="">Select Category</option>
                              @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach

                        </select>
                        <font style="color:red">{{($errors->has('category_id'))?($errors->first('category_id')):''}}</font>
                      </div>

                      <div class="form-group col-md-3">
                        <label for="id3">Product Name</label>
                        <select class="form-control select2" id="product_id" name="product_id" id="3">
                              <option value="">Select Product</option>

                        </select>
                        <font style="color:red">{{($errors->has('product_id'))?($errors->first('product_id')):''}}</font>
                      </div>

                          <div class="form-group col-md-1">
                        <label for="id3">Stock(PCS/KG)</label>
                         <input type="text" name="current_stock_quantity" id="current_stock_quantity" class="current_stock_quantity form-control" readonly style="background-color:#D8FDBA" >
                        <font style="color:red">{{($errors->has('product_id'))?($errors->first('product_id')):''}}</font>
                      </div>

                      <div class="form-group col-md-1" style="padding-top: 20px">
                          <a  class="btn btn-sm btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add</a>
                      </div>




                    </div>

                    <div class="box-body">
                      <form role="form" action="{{route('invoice.store')}}" method="post">
                    @csrf
                        <table class="table-sm table-bordered" width="100%">
                          <thead>
                            <tr>
                              <th width="20%">Category</th>
                              <th width="20%">Product Name</th>
                              <th>PCS/KG</th>
                              <th>Unit Price</th>
                              <th width="15%">Total Price</th>
                              <th width="10%">Action</th>
                            </tr>
                          </thead>

                          <tbody id="addRow" class="addRow">

                          </tbody>

                           <tbody>
                               <tr>
                                   <td class="text-right" colspan="4"> Discount </td>
                                   <td><input type="text" name="discount_amount" id="discount_amount" class="form-control form-control-sm discount_amount text-right" placeholder="Discount Amount" ></td>
                               </tr>
                                <tr>
                                <td class="text-right" colspan="4"> Grand Total </td>
                                <td>
                                  <input type="text" name="estimate_amount" value="0" id="estimate_amount" class="form-control form-control-sm text-right estimate_amount" readonly style="background-color:#D8FDBA">
                                </td>
                                <td></td>
                              </tr>
                          </tbody>
                        </table>
                        <br>
                          <div class="form-row">
                              <div class="form-group col-md-12">
                                  <textarea name="description" id="description"  placeholder="write description here" class="form-control" ></textarea>
                              </div>
                          </div>
                        <br>

                        <div class="form-row">
                              <div class="form-group col-md-4">
                                  <label for="">Paid Status</label>
                                 <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                                     <option value="">Select Status</option>
                                     <option value="full_paid">Full Paid</option>
                                     <option value="full_due">Full Due</option>
                                     <option value="partial_paid">Partial Paid</option>
                                 </select>
                                 <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount" style="display: none" placeholder="Enater Paid Amount">
                              </div>

                              <div class="form-group col-md-8">
                                  <label for="">Customer Name</label>
                                  <select name="customer_id" id="customer_id" class="form-control form-control-sm customer_id select2">
                                     <option value="">Select Customer</option>
                                     <option value="0">New Customer</option>
                                     @foreach($customers as $customer)
                                  <option value="{{$customer->id}}">{{$customer->name}} {{$customer->mobile_no}} {{$customer->address}}</option>
                                     @endforeach
                                     
                                 </select>
                              </div>
                          </div>
                        <br><br>
                           
                        <div class="form-row new_customer col-md-12" style="display: none;">
                            <div class="form-group col-md-3">
                                <input type="text" name="name" id="name" class="form-control form-control-sm name" placeholder="Wrtite Customer Name">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control form-control-sm mobile_no" placeholder="Wrtite Mobile Number">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="email" id="email" class="form-control form-control-sm email" placeholder="Wrtite Email address">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Wrtite Address">
                            </div>
                        </div>
                        
                        <div class="form-row">
                             <div class="form-group col-md-12">
                          <button type="submit" class="btn btn-primary" id="storeButton">Invoice Store</button>
                        </div>
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
    <input type="hidden" name="date" value="@{{date}}">
    <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
    <td>
    <input type="hidden" name="category_id[]" value="@{{category_id}}">
    @{{category_name}}
    </td>
    <td>
    <input type="hidden" name="product_id[]" value="@{{product_id}}">
    @{{product_name}}
    </td>
    <td>
    <input type="number" name="selling_qty[]" min="1" value="1" class="form-control form-control-sm text-right selling_qty" value="@{{selling_qty}}">
    </td>
     <td>
    <input type="number" name="unit_price[]"  value="1" class="form-control form-control-sm text-right unit_price" >
    </td>
    <td>
    <input type="text" name="selling_price[]"   class="form-control form-control-sm text-right selling_price" value="0" readonly>
    </td>
    <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>
  </script>

  <script type="text/javascript">
   $(document).ready(function(){
       $(document).on("click",".addeventmore",function(){
           var date = $('#date').val();
           var invoice_no = $('#invoice_no').val();
           var category_id = $('#category_id').val();
           var category_name = $('#category_id').find('option:selected').text();
           var product_id = $('#product_id').val();
           var product_name = $('#product_id').find('option:selected').text();

           if(date == ''){
               $.notify("Date is required", {globalPosition:'top right',className:'error'});
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
                  invoice_no:invoice_no,
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

       $(document).on('keyup click','.unit_price,.selling_qty',function(){
           var unit_price = $(this).closest("tr").find("input.unit_price").val();
           var qty = $(this).closest("tr").find("input.selling_qty").val();
           var total = unit_price * qty;
           $(this).closest("tr").find("input.selling_price").val(total);
           $('#discount_amount').trigger('keyup');
       });

       $(document).on('keyup','#discount_amount',function(){
          totalAmountPrice();
       });

       //calculate sum of amount in invoice

       function totalAmountPrice(){
           var sum =0;
           $(".selling_price").each(function(){
               var value = $(this).val();
               if(!isNaN(value) && value.length != 0){
                   sum += parseFloat(value);
               }
           });
           var discount_amount = parseFloat($('#discount_amount').val());
           if(!isNaN(discount_amount) && discount_amount.length !=0){
               sum -= parseFloat(discount_amount);
           }
           $('#estimate_amount').val(sum);
       }


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

    <script>
        $(function(){
            $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                $.ajax({
                   url:"{{route('check-product-stock')}}",
                   type:"GET",
                   data:{product_id:product_id},
                   success:function(data){
                      $('#current_stock_quantity').val(data);
                   }
                });
            });
        });
    </script>

    <script>
        $(document).on('change','#paid_status',function(){
            //paid status
         var paid_status = $(this).val();
         if(paid_status == 'partial_paid'){
             $('.paid_amount').show();
         }else{
             $('.paid_amount').hide();
         }

        });
    </script>
    <script>
        $(document).on('change','#customer_id',function(){
            //new customer
            var customer_id = $(this).val();
         if(customer_id == '0'){
             $('.new_customer').show();
         }else{
             $('.new_customer').hide();
         }
        });
    </script>
  @endpush



