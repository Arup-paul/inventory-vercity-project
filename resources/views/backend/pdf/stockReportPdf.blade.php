<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock  Report Pdf</title>

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
                             <td width="40%"></td>
                             <td width="30%">
                              <u> <strong><span> Stock Report</span></strong></u>
                             </td>
                             <td width="30%">  </td>
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
