<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomersController extends Controller {
    public function view() {
        $data['data'] = Customers::all();
        return view( 'backend.customer.view_customer', $data );
    }

    public function add() {
        return view( 'backend.customer.add_customer' );
    }

    public function store( Request $request ) {

        $Validator = Validator::make( $request->all(), [
            'name' => 'required|min:4',
            'mobile_no' => 'required',
            'email' => 'required|email|unique:customers',
            'address' => 'required',
            'status' => 'required',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }

        $data            = new Customers();
        $data->name      = $request->name;
        $data->mobile_no = $request->mobile_no;
        $data->email     = $request->email;
        $data->address   = $request->address;
        $data->status    = $request->status;
        $data->created_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Customers Added' );
        return redirect()->route( 'customers.view' );
    }

    public function edit( $id ) {
        $data = Customers::find( $id );
        return view( 'backend.customer.edit_customer', compact( 'data' ) );
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
        $data            = Customers::find( $id );
        $data->name      = $request->name;
        $data->mobile_no = $request->mobile_no;
        $data->email     = $request->email;
        $data->address   = $request->address;
        $data->status    = $request->status;
        $data->updated_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Customers Updated' );
        return redirect()->route( 'customers.view' );
    }

     public function delete($id){
       $user = Customers::find($id);
       $user->delete();
       session()->flash( 'type', 'success' );
       session()->flash( 'msg', 'Customers Deleted' );
       return redirect()->route('customers.view');
    }

}
