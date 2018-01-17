<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lease;

class CheckController extends Controller{
    
    public function index(){
        echo "string";
    }

    public function create(){}

    public function store(Request $request){

        if(Lease::where('room_id', '=', $request->get('room_id'))->where('is_active', '=', 1)->exists()) {
            $data = array('message' => "1");
            return json_encode($data);
        }else{
            $data = array('message' => "0");
            return json_encode($data);
        }
    }

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){
        $prev_room = Lease::where('room_id', '=', $request->get('room_id'))->first();

        if($prev_room->room_number == $request->room_number){
            $data = array('message' => "0");
            return json_encode($data);
        }else{
            if(Lease::where('room_id', '=', $request->get('room_id'))->where('is_active', '=', 1)->exists()) {
                $data = array('message' => "1");
                return json_encode($data);
            }else{
                $data = array('message' => "0");
                return json_encode($data);
            }
        }
    }

    public function destroy($id){}
}
