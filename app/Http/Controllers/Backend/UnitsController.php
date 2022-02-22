<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UnitsController extends Controller
{
     public function view() {
        $data['data'] = Unit::all();
        return view( 'backend.unit.index', $data );
    }

    public function add() {
        return view( 'backend.unit.create' );
    }

    public function store( Request $request ) {

        $Validator = Validator::make( $request->all(), [
            'name' => 'required',
            'status' => 'required',
        ] );

        if ( $Validator->fails() ) {
            return redirect()->back()->withErrors( $Validator )->withInput();
        }

        $data            = new Unit();
        $data->name      = $request->name;
        $data->status    = $request->status;
        $data->created_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Unit Added' );
        return redirect()->route( 'units.view' );
    }

    public function edit( $id ) {
        $data = Unit::find( $id );
        return view( 'backend.unit.edit', compact( 'data' ) );
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
        $data            = Unit::find( $id );
        $data->name      = $request->name;
        $data->status    = $request->status;
        $data->updated_by = Auth::user()->id;
        $data->save();
        session()->flash( 'type', 'success' );
        session()->flash( 'msg', 'Units Updated' );
        return redirect()->route( 'units.view' );
    }

     public function delete($id){
       $user = Unit::find($id);
       $user->delete();
       session()->flash( 'type', 'success' );
       session()->flash( 'msg', 'Unit Deleted' );
       return redirect()->route('units.view');
    }

}
