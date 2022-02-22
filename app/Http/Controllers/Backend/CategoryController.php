<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
     public function view() {
        $data['data'] = Category::all();
        return view( 'backend.category.index', $data );
    }

    public function add() {
        return view( 'backend.category.create' );
    }

    public function store( Request $request ) {

        $Validator = Validator::make( $request->all(), [
            'name' => 'required',
            'status' => 'required',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }

        $data            = new Category();
        $data->name      = $request->name;
        $data->status    = $request->status;
        $data->created_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Category Added' );
        return redirect()->route( 'categories.view' );
    }

    public function edit( $id ) {
        $data = Category::find( $id );
        return view( 'backend.category.edit', compact( 'data' ) );
    }

    public function update( $id, Request $request ) {
        $Validator = Validator::make( $request->all(), [
            'name' => 'required',
            'status' => 'required',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }
        $data            = Category::find( $id );
        $data->name      = $request->name;
        $data->status    = $request->status;
        $data->updated_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Category Updated' );
        return redirect()->route( 'categories.view' );
    }

     public function delete($id){
       $user = Category::find($id);
       $user->delete();
       session()->flash( 'type', 'success' );
       session()->flash( 'msg', 'Category Deleted' );
       return redirect()->route('categories.view');
    }
}
