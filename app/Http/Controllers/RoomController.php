<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $rooms = Room::all()->where('is_active', true)->where('created_by', Auth::user()->getAuthIdentifier());
//        return view ('admin.room.index', compact('rooms'));
        //
        $rooms = $this->getActiveRoomList();
        return view ('admin.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['rooms'] = DB::table('rooms')->select('id', 'room_number')->get();
        $data['users'] = DB::table('users')->select('id', 'first_name')->get();
//        return view('admin.maintenances.create', $data);

        return view('admin.room.CreateOrUpdate', $data);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room = new Room([
            'room_number' => $request->get('room_number'),
            'size' => $request->get('size'),
            'description' => $request->get('description'),
            'created_by' => Auth::user()->getAuthIdentifier()
        ]);

        if (!Room::where('room_number', '=', $request->get('room_number'))->exists()) {
            if($room->save()){
                $data = array('error' => false, 'message' => "sucess");
                return json_encode($data);
            }else{
                $data = array('error' => true, 'message' => "Error");
                return json_encode($data);
            }
        }else{
            $data = array('error' => true, 'message' => "The room are already exists!");
            return json_encode($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rooms = DB::table('lease_settings')
            ->join('leases', 'leases.id', '=', 'lease_settings.lease_id')
            ->join('rooms', 'rooms.id', '=', 'leases.room_id')
            ->select('*')
            ->where('lease_settings.is_active', '=', 1)
            ->where('leases.is_active', '=', 1)
            ->where('rooms.id', '=', $id)
            ->get();
        return response()->json($rooms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = $this->getActiveRoom($id);
        $isEdit = true;
        if ($room != null) {
            return view('admin.room.CreateOrUpdate', compact(['room', 'isEdit']));
        }

        throw new \ErrorException('404');
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $room = $this->getActiveRoom($id);
        if ($room != null) {
            $room->room_number = $request->room_number;
            $room->description = $request->description;
            $room->size = $request->size;

            $prev_room = Room::where('id', '=', $id)->first();

            if($prev_room->room_number == $request->room_number){
                if($room->save()){
                    $data = array('error' => false, 'message' => "sucess");
                    return json_encode($data);
                }else{
                    $data = array('error' => true, 'message' => "Error");
                    return json_encode($data);
                }
            }

            if(!Room::where('room_number', '=', $request->get('room_number'))->exists()) {
                if($room->save()){
                    $data = array('error' => false, 'message' => "sucess");
                    return json_encode($data);
                }else{
                    $data = array('error' => true, 'message' => "Error");
                    return json_encode($data);
                }
            }else{
                $data = array('error' => true, 'message' => "The room are already exists!");
                return json_encode($data);
            }
        }
    }

    public function delete($id)
    {
        $room = $this->getActiveRoom($id);
        return view('admin.room.delete', compact('room'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //
    }

    public function deleteConfirm($id) {

        $room = $this->getActiveRoom($id);
        if ($room != null) {
            $room->is_active = false;
            $room->save();
        }
        return json_encode("success");
    }

    private function getActiveRoom($id) {
        return Room::where('id', $id)->where('is_active', true)->where('created_by', Auth::user()->getAuthIdentifier())->first();
    }

    private function getActiveRoomList() {
        $rooms = Room::all()->where('is_active', true)->where('created_by', Auth::user()->getAuthIdentifier());
        return $rooms;
    }
}
