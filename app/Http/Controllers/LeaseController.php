<?php

namespace App\Http\Controllers;

use App\Libs\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Lease;
use App\LeaseSetting;

class LeaseController extends Controller{
    
    public function index(){
        $condition;

        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        $condition = $user->hasRole('admin') ? $user->id : $user->created_by;

        $leases = DB::table('leases')
            ->join('rooms', 'rooms.id', '=', 'leases.room_id')
            ->join('users', 'users.room_id', '=', 'rooms.id')
            ->select('leases.*', 'rooms.room_number', 'users.first_name', 'users.last_name')
            ->where('leases.is_active', '=', 1)
            ->where('users.is_active', '=', 1)
            ->where('rooms.created_by', $condition)
            ->get();
        return view('admin.lease.index', compact('leases'));
    }

    
    public function create(){
        $rooms = Helpers::getRoomOfCurrentUser();
        return view('admin.lease.create')->with('rooms', $rooms);
    }

    
    public function store(Request $request){
        
        $lease = new Lease();
        $lease->room_id = $request->get('room_id');
        $lease->start_current_reading_electric = $request->get('start_current_reading_electric');
        $lease->start_current_reading_water = $request->get('start_current_reading_water');
        $lease->is_active = ($request->get('is_active')==1) ? 1 : 0;
        $lease->save();
        $id = $lease->id;
    
        $data = [];
        for($i = 0; $i<count($request->get('start_date')); $i++){
            $data[] = array(
                'start_date'=> Carbon::createFromFormat('m/d/Y', $request->get('start_date')[$i]),
                'end_date'=> Carbon::createFromFormat('m/d/Y', $request->get('end_date')[$i]),
                'room_price'=> $request->get('room')[$i],
                'electric_price'=> $request->get('electrict')[$i],
                'water_price'=> $request->get('water')[$i],
                'lease_id' => $id 
            );
        }
        //var_dump($data);
        LeaseSetting::insert($data); // Eloquent
        return redirect('lease');
    }

    // Use for get the room price
    public function show($id){
        $rooms = DB::table('rooms')
            ->join('price_setting', 'price_setting.created_by', '=', 'rooms.created_by')
            ->select('price_setting.unit_supply', 'price_setting.electric_supply', 'price_setting.water_supply')
            ->where('rooms.id', '=', $id)
            ->get();
        return response()->json($rooms);
    }

    
    public function edit($id){

        $rooms = Helpers::getRoomOfCurrentUser();

        $lease = Lease::find($id);

        $leasesettings = LeaseSetting::where('lease_id', '=', $id)->where('is_active', 1)->get();
        

        return view('admin.lease.edit', compact('lease','rooms','leasesettings'));
    }

    
    public function update(Request $request, $id){

        $lease = Lease::where('id', $id)->first();
        $lease->room_id = $request->get('room_id');
        $lease->start_current_reading_electric = $request->get('start_current_reading_electric');
        $lease->start_current_reading_water = $request->get('start_current_reading_water');
        $lease->is_active = ($request->get('is_active')==1) ? 1 : 0;
        $lease->save();
        $index = 1;
        if (isset($request->id) && $request->id != null && count($request->id) > 0) {
            $integerIDs = array_map('intval', explode(',', implode(",", $request->id)));
            DB::table('lease_settings')->where('lease_id', $id)->whereNotIn('id', $integerIDs)->update(['is_active' => 0]);

            foreach ($request->start_date as $i => $value) {
                $leaseSetting = count($request->id) <= count($request->start_date) ? LeaseSetting::where('id', $request->id[$i])->first() : null;
                if (!isset($leaseSetting) || $leaseSetting == null) {
                    $leaseSetting = new LeaseSetting();
                    $leaseSetting->lease_id = $lease->id;
                }

                $leaseSetting->start_date = Carbon::createFromFormat('m/d/Y', $request->start_date[$i]);
                $leaseSetting->end_date = Carbon::createFromFormat('m/d/Y', $request->end_date[$i]);
                $leaseSetting->room_price = $request->room[$i];
                $leaseSetting->electric_price = $request->electrict[$i];
                $leaseSetting->water_price = $request->water[$i];

                $leaseSetting->save();
            }
        } else {
            DB::table('lease_settings')->where('lease_id', $id)->update(['is_active' => 0]);
        }
        return redirect('lease');
    }

    
    public function destroy($id){
        $lease = Lease::find($id);
        $lease->is_active = 0;
        if($lease->save()){
            echo "1";
        }
    }
}
