<?php

namespace App\Http\Controllers;

use App\Lease;
use App\LeaseSetting;
use App\Libs\Helpers;
use App\Payment;
use App\PriceSetting;
use App\Room;
use App\Usage;
use App\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use App\Mail\SendInvoice;
//use App\PriceSetting;
//use App\Usage;
//use App\Room;
//use App\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Auth;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->join('permission_role', 'permission_role.role_id', '=', 'roles.id')
            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->select('users.*')
            ->where('permissions.name', '=', 'scanning')
            ->where('users.email','=','devtest3@onestoneinc.com')
            ->get();

        foreach ($users as $user) {
            echo $user->email;
        }

        var_dump($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        DB::table('usages')->insert(['electric_new' => 12]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room_id = $request->get('room_number');
//       $room_id = $request->get('room_id');
        $room = Room::find($room_id);
        if ($room != null) {
//        var_dump($room_id);
            $type = $request->get('type');
            $user = User::where('room_id', $room_id)->where('is_active', true);
            $currentReading = $request->get('current_reading');
            $firstDayPreMonth = date("Y-m-d H:i:s", strtotime("first day of previous month"));
            $lastDayPreMonth = date("Y-m-d H:i:s", strtotime("last day of previous month"));
            $currentDate = date("Y-m-d H:i:s");
            $price_setting = PriceSetting::where('created_by', $room->created_by)->where('is_active', true)->first();
            $lease_setting = Helpers::getCurrentLeaseSettingByRoomId($room_id);

            $lastUsage = Usage::where('room_id', $room_id)->where('is_paid', false)->where('end_date', '>', $lastDayPreMonth)->orderBy('id', 'DESC')->first();
            $isOnePaid = $this->isAtLessOnePaid($lastUsage);
            $lastMonthUsageArr = $this->getlastMonthRecord($room_id, $firstDayPreMonth, $lastDayPreMonth);
            $lastMonthUsage = $lastMonthUsageArr != null && count($lastMonthUsageArr) > 0 ? $lastMonthUsageArr[0] : null;

            // validation

            // end validation
            $roomUsage = Usage::where('room_id', $room_id);


            // to get current value from lease
            $current_water_reading = 0;
            $current_electric_reading = 0;
            if (isset($lease_setting) && $lease_setting != null) {

                if ($lastUsage != null && !$isOnePaid) {
                    $tempUsage = Usage::all()->where('lease_setting_id', $lease_setting[0]->id)->where('id', '<>', $lastUsage->id)->first();
                } else {
                    $tempUsage = Usage::all()->where('lease_setting_id', $lease_setting[0]->id)->first();
                }

                $tempLeases = Lease::find($lease_setting[0]->id);
                if (!isset($tempUsage) || $tempUsage == null) {
                    if ($tempLeases->start_current_reading_electric != null && $tempLeases->start_current_reading_electric != 0) {
                        $current_electric_reading = $tempLeases->start_current_reading_electric;
                    }

                    if ($tempLeases->start_current_reading_water != null && $tempLeases->start_current_reading_water != 0) {
                        $current_water_reading = $tempLeases->start_current_reading_water;
                    }
                }
            }

            // validation
            $dataValidation = $this->formValidation($type, $current_water_reading, $current_electric_reading, $currentReading, $lastMonthUsage);
            if (isset($dataValidation) && $dataValidation != null && count($dataValidation) > 0) {
                return json_encode($dataValidation);
            }

            if ($lastUsage == null || $isOnePaid) {
                $usage = new Usage();
                $usage->start_date = $lastMonthUsage != null ? $lastMonthUsage->end_date : ( $roomUsage != null && count($roomUsage)? $currentDate : $user->start_date);
                $usage->room_id = $room_id;
                $usage->is_paid = false;
                $usage->end_date = $currentDate;
                $usage->price_setting_id = $price_setting->id;
                $usage->lease_setting_id = isset($lease_setting) && $lease_setting!= null && count($lease_setting) >0 ? $lease_setting[0]->id : null;
//
                if ($type == 'water') {
                    $usage->water_new = $currentReading;
                    $usage->water_old = ($current_water_reading == 0 ? ($lastMonthUsage != null ? $lastMonthUsage->water_new : 0) : $current_water_reading);
                } else {
                    $usage->electric_new = $currentReading;
                    $usage->electric_old = ($current_electric_reading == 0 ? ($lastMonthUsage != null ? $lastMonthUsage->electric_new : 0) : $current_electric_reading);
                }
                $usage->save();
            } else {

                $lastUsage->lease_setting_id = isset($lease_setting) && $lease_setting!= null && count($lease_setting) >0 ? $lease_setting[0]->id : null;
                if ($type == 'water') {

                    if($lastMonthUsage != null && $lastMonthUsage->water_new != 0 && $current_water_reading == 0) {
                        $lastUsage->water_old = $lastMonthUsage->water_new;
                    } elseif($current_water_reading > 0) {
                        $lastUsage->water_old = $current_water_reading;
                    }

                    $lastUsage->water_new = $currentReading;
                } else {
                    if($lastMonthUsage != null && $lastMonthUsage->electric_new != 0 && $current_electric_reading == 0) {
                        $lastUsage->electric_old = $lastMonthUsage->electric_new;
                    } elseif($current_electric_reading > 0) {
                        $lastUsage->electric_old = $current_electric_reading;
                    }
                    $lastUsage->electric_new = $currentReading;
                }

                $lastUsage->save();
            }

            $data = array('error' => false, 'message' => "Successfully");
            return json_encode($data);
        }
        else {
            $data = array('error' => true, 'message' => "Room is invalid.");
            return json_encode($data);
        }
    }

    private function getlastMonthRecord($roomId, $firstDate, $lastDate) {
        $strSql = "SELECT usages.* FROM usages ";
        $strSql .= "INNER JOIN payments ON payments.usage_id = usages.id ";
        $strSql .= "WHERE (usages.room_id = ? ";
        $strSql .= "AND usages.end_date >= ? ";
        $strSql .= "AND usages.end_date <= ?) ";
        $strSql .= "OR ((payments.is_electric_paid = true OR payments.is_water_paid = true OR payments.is_room_paid = true) AND usages.room_id = ?) ";
        $strSql .= "ORDER BY usages.created_at DESC ";

        return DB::select($strSql, [$roomId, $firstDate, $lastDate, $roomId]);
    }

    private function isAtLessOnePaid($lastUsage) {
        if (isset($lastUsage) && $lastUsage != null) {
            $payment = Payment::all()->where('usage_id', $lastUsage->id)->first();
            if (isset($payment) && $payment != null) {
                return $payment->is_water_paid || $payment->is_electric_paid || $payment->is_room_paid;
            }
        }
        return false;
    }

    private function formValidation($type, $current_water_reading, $current_electric_reading, $currentReading, $lastMonthUsage) {
        if ($type == 'water') {
            $isError = $current_water_reading > 0 ? $currentReading <= $current_water_reading : ($lastMonthUsage != null ? $currentReading <= $lastMonthUsage->water_new : false) ;

            if ($isError) {
                return array('error' => true, 'message' => "Water : The current number must be greater than previous number");
//                return json_encode($data);
            }
        } else {
            $isError = $current_electric_reading > 0 ? $currentReading <= $current_electric_reading : ($lastMonthUsage != null ? $currentReading <= $lastMonthUsage->electric_new : false) ;
            if ($isError) {
                return array('error' => true, 'message' => "Electric : The current number must be greater than previous number");
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
        $user = User::find($id);
        $strSql = "SELECT DISTINCT rooms.* ";
        $strSql .= "FROM rooms ";
        $strSql .= "INNER JOIN users ON users.room_id = rooms.id ";
        $strSql .= "WHERE users.is_active = ? AND rooms.is_active = ? AND rooms.created_by = ?";
        if ($user->hasRole('admin')) {
            $rooms = DB::select($strSql, [1, 1, $user->id]);
        } else {
            $rooms = DB::select($strSql, [1, 1, $user->created_by]);
        }

        echo json_encode($rooms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $data = array('error' => false, 'id' => Auth::user()->getAuthIdentifier());
            return json_encode($data);
        }

        $data = array('error' => true, 'message' => "Wrong user and password");
        return json_encode($data);
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
}
