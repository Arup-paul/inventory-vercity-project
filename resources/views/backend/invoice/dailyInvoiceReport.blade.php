@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Invoice</li>
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
            <h3 class="box-title">Select Criteria  </h3>
            </div>



            <!-- /.box-header -->

                    <div class="box-body">
                        <div class="row">

                        <form action="{{route('daily.invoice.report.pdf')}}" target="_blank" method="GET"  id="myFrom">
                     <div class="form-group col-md-4">
                        <label for="id1">Start Date</label>
                        <input type="text" required placeholder="YYYY-MM-DD"  class="form-control form-control-sm datepicker" id="start_date" name="start_date" >
                      </div>

                      <div class="form-group col-md-4">
                        <label for="id1">End Date</label>
                        <input type="text" required placeholder="YYYY-MM-DD"  class="form-control form-control-sm datepicker" id="end_date" name="end_date" >
                      </div>

                      <div class="form-group col-md-1" style="padding-top: 20px">
                         <button type="submit" class="btn btn-primary btn-sm">Search</button>
                      </div>
                      </form>    






                    </div>

                    
            </div>
        </div>
    </div>


  @endsection

  @push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myFrom').validate({
                rules:{
                    start_date:{
                        required:true,
                    },
                    end_date{
                        required:true,
                    }
                },
                messages:{

                },
                errorElement: 'span',
            });
        });
    </script>
  @endpush



