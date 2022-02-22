<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Invoice Report Pdf</title>

</head>
<body>

     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <table width="100%">
                     <tbody>
                         <tr>
                             <td></td>
                             <td>
                                 <span><strong> Organazation Name</strong></span> <br>
                                Chattogram
                             </td>
                             <td>
                                 mobile No : 01866702189 <br>
                                 mobile no: 01866702189
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
         <hr style="margin-bottom: 0px">
            <div class="row">
             <div class="col-md-12">
                 <table width="100%" >
                     <tbody>
                         <tr>
                             <td width="20%"></td>
                             <td width="60%">
                              <u> <strong><span> Daily Invoice Report({{date('d-m-Y',strtotime($start_date))}} - {{date('d-m-Y',strtotime($start_date))}})</span></strong></u>
                             </td>
                             <td width="20%">  </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>

      <div class="row">
          <div class="col-md-12">
               <table border="1" width="100%">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Customer Name</th>
                  <th>Invoice No</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                    @php
                      $total_sum = '0';  
                    @endphp
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
                  
                 @php
                   $total_sum +=  $single_data->payment->total_amount;
                 @endphp
                </tr>
                
                @endforeach
                <tr>
                    <td colspan="5" style="text-align: right">Grand Total</td>
                   <td>BDT {{$total_sum}}</td>
                </tr>







                </tfoot>
              </table>
          </div>
      </div>


           @php
                 $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
               @endphp
               <i>Printing Time : {{$date->format('F j, Y, g:i a')}}</i>

               <div class="row">
                   <div class="col-md-12">
                       <table border="0" width="100%">
                           <tbody>
                               <tr>
                                  <td style="width:40%;">
                                  </td>
                                  <td style="width:20%;"></td>
                                  <td style="width:40%; text-align:center;">
                                  <p style="text-align:center; border-bottom:1px solid #000;">Owner Signature</p>
                                  </td>
                               </tr>
                           </tbody>
                       </table>

                   </div>
               </div>
     </div>






</body>
</html>
