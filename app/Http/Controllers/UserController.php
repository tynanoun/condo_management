<?php

namespace App\Http\Controllers;

use App\Libs\Helpers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\User;
use App\Room;
use App\Role;
use Illuminate\Support\Facades\Auth;
use PDF;

use App\Http\Requests;
use DB;

class UserController extends Controller
{

    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($isStaffVar)
    {
        $isStaff = $this->convertStringToBoolean($isStaffVar);
        $users = $this->getActiveUser($isStaff);

        return view ('admin.user.index', compact(['users', 'isStaff']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($isStaff)
    {
        $roles = Role::all()->where('is_active', true)->where('is_staff', $this->convertStringToBoolean($isStaff));
        if (!$this->convertStringToBoolean($isStaff)) {
            $rooms = Helpers::getAllActiveRooms();
        }
        return view('admin.user.createOrUpdate', compact(['roles', 'rooms', 'isStaff']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageFileName = '';
        if ($image != null) {
            $imageFileName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageFileName);
        }

        if (User::where('room_id', '=', $request['room_id'])->exists()) {
            $data = array('error' => true, 'message' => "Room is already exists!");
            return json_encode($data);
        }

        $user = new User();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->contact_number = $request['contact_number'];
        $user->main_contact = $request['main_contact'];
        $user->is_active = true;
        $user->building_id = 1;
        $user->room_id = $request['room_id'];
        $user->start_date = $request->get('start_date');
        $user->end_date = $request->get('end_date');
        $user->image = $imageFileName != '' ? $imageFileName : '';
        $user->created_by = Auth::user()->getAuthIdentifier();
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);

        $user->save();

        $user->attachRole(Role::where('id', $request['role_id'])->first());

        $data = array('error' => false, 'message' => "success");
        return json_encode($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $isStaff)
    {
//
        $user = User::find($id);
//        $roles = Role::all()->where('is_active', true)->where('is_staff', false);
//        $rooms = Room::all()->where('is_active', true);

        $roles = Role::all()->where('is_active', true)->where('is_staff', $this->convertStringToBoolean($isStaff));
        if (!$this->convertStringToBoolean($isStaff)) {
            $rooms = Helpers::getAllActiveRooms();
        }
        $isEdit = true;
        return view('admin.user.createOrUpdate', compact(['user', 'roles', 'rooms', 'isStaff', 'isEdit']));
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
        $image = $request->file('image');
        $imageFileName = '';
        if ($image != null) {
            $imageFileName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageFileName);
        }

        $user = User::find($id);

        if ($user->room_id == $request->get('room_id')) {
        
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->contact_number = $request->get('contact_number');
            $user->main_contact = $request->get('main_contact');
            $user->room_id = $request->get('room_id');
            $user->email = $request->get('email');
            if ($imageFileName != null && $imageFileName != '') {
                $user->image = $imageFileName;
            }
            $user->start_date = $request->get('start_date');
            $user->end_date = $request->get('end_date');

            $role = Role::all()->where('id', $request['role_id']);
            $user->roles()->sync($role);

            if ($request['password'] != null && $request['password'] != '') {
                $user->password = $request->get('password');
            }

            $user->save();

            $data = array('error' => false, 'message' => "success");
            return json_encode($data);
            
        }else{

            if(User::where('room_id', '=', $request['room_id'])->exists()){

                $data = array('error' => true, 'message' => "Room is already exists!");
                return json_encode($data);
            }else{

                $user->first_name = $request->get('first_name');
                $user->last_name = $request->get('last_name');
                $user->contact_number = $request->get('contact_number');
                $user->main_contact = $request->get('main_contact');
                $user->room_id = $request->get('room_id');
                $user->email = $request->get('email');
                if ($imageFileName != null && $imageFileName != '') {
                    $user->image = $imageFileName;
                }
                $user->start_date = $request->get('start_date');
                $user->end_date = $request->get('end_date');

                $role = Role::all()->where('id', $request['role_id']);
                $user->roles()->sync($role);

                if ($request['password'] != null && $request['password'] != '') {
                    $user->password = $request->get('password');
                }

                $user->save();

                $data = array('error' => false, 'message' => "success");
                return json_encode($data);

            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $customer = User::find($id);
        return view ('admin.user.delete', compact('customer'));
        //
    }

    public function deleteConfirm($id) {
        $user = User::find($id);
        $user->is_active = false;

        $user->save();

        return json_encode("success");
    }


    public function getCustomerProfile($id, $isStaffVar) {
        $isStaff = $this->convertStringToBoolean($isStaffVar);
        $customer = User::find($id);

        $strSql = "SELECT DISTINCT usages.* ";
        $strSql .= "FROM users ";
        $strSql .= "INNER JOIN rooms on users.room_id = rooms.id ";
        $strSql .= "INNER JOIN usages on usages.room_id = rooms.id ";
        $strSql .= "INNER JOIN role_user on users.id = role_user.user_id ";
        $strSql .= "INNER JOIN roles on roles.id = role_user.role_id ";
        $strSql .= "WHERE rooms.is_active = ? and users.is_active = ? ";
        $strSql .= "AND roles.is_staff = ? AND rooms.id = ?";

        $usages = DB::select($strSql, [1, 1, $isStaff, $customer->room_id]);

        return view ('admin.user.profile', compact(['customer', 'usages', 'isStaff']));
    }

    private function getActiveUser($isStaff) {
        if (Auth::user()->hasRole('admin')) {
            $customers = User::All()->where('is_active', true)->where('created_by', Auth::user()->getAuthIdentifier());
        } else {
            $customers = User::All()->where('is_active', true)->where('id', Auth::user()->getAuthIdentifier());
        }

        if ($isStaff) {
            return $customers->where('room_id', null);
        }
        return $customers->where('room_id','<>', null);
    }

    private function convertStringToBoolean($string) {
        if ($string === 'true') {
            return true;
        } elseif ($string === 'false') {
            return false;
        } else {
            throw new \ErrorException('404');
        }
    }
}
