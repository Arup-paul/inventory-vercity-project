<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Supplier;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function view(){
        $data['data'] = Supplier::all();
        return view('backend.supplier.view_supplier',$data);
    }

    public function add(){
        return view('backend.supplier.add_supplier');
    }

    public function store(Request $request){

        $Validator = Validator::make($request->all(),[
            'name' =>'required|min:4',
            'mobile_no' =>'required',
            'email'=> 'required|email|unique:suppliers',
            'address'=>'required',
            'status'=>'required'
           ]);


           if($Validator->fails()){
                  return redirect()->back()->withErrors($Validator)->withInput( );
           }

        $data = new Supplier();
        $data->name = $request->name;
        $data->mobile_no = $request->mobile_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->status = $request->status;
        $data->created_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Suppliers Added' );
        return redirect()->route('suppliers.view');
    }


    public function edit( $id ) {
        $data = Supplier::find( $id );
        return view( 'backend.supplier.edit_supplier', compact( 'data' ) );
    }

    public function update( $id, Request $request ) {
        $Validator = Validator::make( $request->all(), [
            'name' => 'required|min:4',
            'mobile_no' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'status' => 'required',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }
        $data            = Supplier::find( $id );
        $data->name      = $request->name;
        $data->mobile_no = $request->mobile_no;
        $data->email     = $request->email;
        $data->address   = $request->address;
        $data->status    = $request->status;
        $data->updated_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Supplier Updated' );
        return redirect()->route( 'suppliers.view' );
    }

     public function delete($id){
       $user = Supplier::find($id);
       $user->delete();
       session()->flash( 'type', 'success' );
       session()->flash( 'msg', 'Suppliers Deleted' );
       return redirect()->route('suppliers.view');
    }
}
