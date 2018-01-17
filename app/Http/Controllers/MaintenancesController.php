<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Maintenance;
use App\User;
use App\Libs\Helpers;

class MaintenancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $condition;

        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        $condition = $user->hasRole('admin') ? $user->id : $user->created_by;

        $user = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('roles.name', 'roles.display_name')
            ->where('users.is_active', '=', 1)
            ->where('users.created_by', '=', $condition)
            ->get()
            ->first();
        $maintenances = DB::table('maintenances')
            ->join('users', 'users.id', '=', 'maintenances.assign_user_id')
            ->join('rooms', 'rooms.id', '=', 'maintenances.room_id')
            ->join('roles', 'roles.id', '=', 'rooms.created_by')
            ->where('users.is_active', '=', 1)
            ->where('rooms.is_active', '=', 1)
            ->where('rooms.created_by', '=', $condition)
            ->select('maintenances.task_name', 'maintenances.id', 'maintenances.description', 'maintenances.updated_at', 'maintenances.status', 'rooms.room_number', 'users.first_name')
            ->get();
        return view('admin.maintenances.index', compact('maintenances', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $condition;

        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        $condition = $user->hasRole('admin') ? $user->id : $user->created_by;

        $data = array();
        $data['rooms'] = Helpers::getRoomOfCurrentUser();

        $data['users'] = DB::table('users')
            ->where('users.is_active', '=', 1)
            ->where('users.created_by', '=', $condition)
            ->select('users.id', 'users.first_name', 'users.last_name')
            ->get();
        return view('admin.maintenances.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = $request->action;
        if($action == 'create'){

            $image = $request->image != '' ? time().'.'.$request->image->getClientOriginalExtension() : '';
            if($image != ''){
                $request->image->move(public_path('images'), $image);
            }
            
            $maintenance = new Maintenance();
            $maintenance->room_id = $request->room_id;
            $maintenance->task_name = $request->task_name;
            $maintenance->assign_user_id = $request->user_id;
            $maintenance->start_date = Carbon::createFromFormat('m/d/Y', $request->start_date);
            $maintenance->end_date = Carbon::createFromFormat('m/d/Y', $request->end_date);
            $maintenance->description = $request->description;
            $maintenance->image = $image;

            if($maintenance->save()){
                $data = array('error' => false, 'message' => "sucess");
                return json_encode($data);
            }else{
                $data = array('error' => true, 'message' => "Error");
                return json_encode($data);
            }
        }

        if($action == 'update'){
            
            $image = $request->image != '' ? time().'.'.$request->image->getClientOriginalExtension() : '';
            if($image != ''){
                $request->image->move(public_path('images'), $image);
            }

            $maintenance = Maintenance::find($request->id);
            $maintenance->room_id = $request->room_id;
            $maintenance->task_name = $request->task_name;
            $maintenance->assign_user_id = $request->user_id;
            $maintenance->start_date = Carbon::createFromFormat('m/d/Y', $request->start_date);
            $maintenance->end_date = Carbon::createFromFormat('m/d/Y', $request->end_date);
            $maintenance->description = $request->description;
            $maintenance->image = $image;

            if($maintenance->save()){
                $data = array('error' => false, 'message' => "sucess");
                return json_encode($data);
            }else{
                $data = array('error' => true, 'message' => "Error");
                return json_encode($data);
            }
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
        $condition;

        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        $condition = $user->hasRole('admin') ? $user->id : $user->created_by;

        $maintenance = DB::table('maintenances')
            ->join('users', 'users.id', '=', 'maintenances.assign_user_id')
            ->join('rooms', 'rooms.id', '=', 'maintenances.room_id')
            ->select('maintenances.*', 'rooms.room_number', 'users.first_name', 'users.last_name')
            ->where('users.is_active', '=', 1)
            ->where('users.created_by', '=', $condition)
            ->get();
        return view('admin.maintenances.work', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms = Helpers::getRoomOfCurrentUser();

        $condition;

        $userId = Auth::user()->getAuthIdentifier();
        $user = User::find($userId);

        $condition = $user->hasRole('admin') ? $user->id : $user->created_by;

        $users = DB::table('users')
            ->where('users.is_active', '=', 1)
            ->where('users.created_by', '=', $condition)
            ->select('users.id', 'users.first_name', 'users.last_name')
            ->get();

        $maintenance = DB::table('maintenances')
            ->join('users', 'users.id', '=', 'maintenances.assign_user_id')
            ->join('rooms', 'rooms.id', '=', 'maintenances.room_id')
            ->select('maintenances.*', 'rooms.room_number', 'users.first_name', 'users.last_name')
            ->where('maintenances.id', '=', $id)
            ->get();
        return view('admin.maintenances.edit', compact('maintenance'))->with('rooms', $rooms)->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $maintenance = Maintenance::find($id);
        $maintenance->room_id = $request->room_id;
        $maintenance->task_name = $request->task_name;
        $maintenance->assign_user_id = $request->user_id;
        $maintenance->start_date = $request->start_date;
        $maintenance->end_date = $request->end_date;
        $maintenance->description = $request->description;

        if($maintenance->save()){
            $data = array('error' => false, 'message' => "sucess");
            return json_encode($data);
        }else{
            $data = array('error' => true, 'message' => "Error");
            return json_encode($data);
        }
    }

    public function destroy($id){}

}
