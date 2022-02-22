<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{
    public function view() {
        $data         = [];
        $data['data'] = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();

        return view( 'backend.purchase.index', $data );
    }

    public function add() {
        $data               = [];
        $data['suppliers']  = Supplier::all();
        $data['products']      = Product::all();
        $data['categories'] = Category::all();
        return view( 'backend.purchase.create', $data );
    }

    public function store( Request $request ) {
          if($request->category_id == null){
              session()->flash( 'type', 'danger' );
             session()->flash( 'msg', 'Sorry! you Do not select any item' );
             return redirect()->back();
          }else{
              $count = count($request->category_id);
              for($i = 0; $i < $count; $i++){
                  $purchase = new Purchase();
                  $purchase->date = date('Y-m-d',strtotime($request->date[$i]));
                  $purchase->purchase_no = $request->purchase_no[$i];
                  $purchase->supplier_id = $request->supplier_id[$i];
                  $purchase->category_id = $request->category_id[$i];
                  $purchase->product_id = $request->product_id[$i];
                  $purchase->buying_qty = $request->buying_qty[$i];
                  $purchase->unit_price = $request->unit_price[$i];
                  $purchase->buying_price = $request->buying_price[$i];
                  $purchase->description = $request->description[$i];
                  $purchase->created_by = Auth::user()->id;
                  $purchase->status = '0';
                  $purchase->save();
              }
              session()->flash( 'type', 'success' );
             session()->flash( 'msg', 'Data Succefully added' );
             return redirect(route('purchase.view'));
          }
       
    }

    public function pendingList(){
        $data         = [];
        $data['data'] = Purchase::orderBy( 'date', 'desc' )->orderBy( 'id', 'desc' )->where('status',0)->get();
        return view( 'backend.purchase.pending', $data );
    }

 

    

    public function delete( $id ) {
        $data = Purchase::find( $id );
        $data->delete();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Purchase Deleted' );
        return redirect()->back();
    }

    public function approve($id){
       $purchase = Purchase::find( $id );
       $product  = Product::where('id',$purchase->product_id)->first();
       $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
       $product->quantity = $purchase_qty;

       if($product->save()){
           DB::table('purchases')
               ->where('id',$id)
               ->update(['status' =>1]);
       }
      session()->flash( 'type', 'success' );
      session()->flash( 'msg', 'Purchase approved successfully' );
     return redirect()->back();
    }
}
