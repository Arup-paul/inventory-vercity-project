<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    public function view() {
        $data         = [];
        $data['data'] = Product::all();

        return view( 'backend.product.index', $data );
    }

    public function add() {
        $data               = [];
        $data['suppliers']  = Supplier::all();
        $data['units']      = Unit::all();
        $data['categories'] = Category::all();
        return view( 'backend.product.create', $data );
    }

    public function store( Request $request ) {

        $Validator = Validator::make( $request->all(), [
            'name' => 'required',
            'quantity' => 'required',
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ], [
            'supplier_id.required' => 'Select Supplier Field',
            'unit_id.required' => 'Select Unit Field',
            'category_id.required' => 'Select Category Field',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }

        $data              = new Product();
        $data->name        = $request->name;
        $data->quantity    = $request->quantity;
        $data->supplier_id = $request->supplier_id;
        $data->unit_id     = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->status      = $request->status;
        $data->created_by  = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Product Added' );
        return redirect()->route( 'products.view' );
    }

    public function edit( $id ) {
        $data               = [];
        $data['product']    = Product::find( $id );
        $data['suppliers']  = Supplier::all();
        $data['units']      = Unit::all();
        $data['categories'] = Category::all();
        return view( 'backend.product.edit', $data );
    }

    public function update( $id, Request $request ) {
        $Validator = Validator::make( $request->all(), [
            'name' => 'required',
            'quantity' => 'required',
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ], [
            'supplier_id.required' => 'Select Supplier Field',
            'unit_id.required' => 'Select Unit Field',
            'category_id.required' => 'Select Category Field',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }
        $data              = Product::find( $id );
        $data->name        = $request->name;
        $data->quantity    = $request->quantity;
        $data->supplier_id = $request->supplier_id;
        $data->unit_id     = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->status      = $request->status;
        $data->updated_by  = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Product Updated' );
        return redirect()->route( 'products.view' );
    }

    public function delete( $id ) {
        $user = Product::find( $id );
        $user->delete();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Product Deleted' );
        return redirect()->route( 'products.view' );
    }
}
