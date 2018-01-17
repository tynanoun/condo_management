<?php

namespace App\Http\Controllers;

use App\Mail\SendInvoice;
use App\PriceSetting;
use App\Usage;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Auth;

class UsageController extends Controller
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
        return $this->viewIndex();
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usage.create');
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
//        $room_id = $request->get('room_id');
////       $room_id = $request->get('room_id');
//        $room = Room::find($room_id);
//        if ($room != null) {
////        var_dump($room_id);
//            $type = $request->get('type');
//            $userId = 1;
//            $currentReading = $request->get('current_reading');
//            $firstDayPreMonth = date("Y-m-d H:i:s", strtotime("first day of previous month"));
//            $lastDayPreMonth = date("Y-m-d H:i:s", strtotime("last day of previous month"));
//            $currentDate = date("Y-m-d H:i:s");
//            $price_setting = PriceSetting::where('created_by', $room->created_by)->where('is_active', true)->first();
//            $lastUsage = Usage::where('room_id', $room_id)->where('is_paid', false)->where('end_date', '>', $lastDayPreMonth)->first();
//
//            $lastMonthUsageArr = $this->getlastMonthRecord($room_id, $firstDayPreMonth, $lastDayPreMonth);
//            $lastMonthUsage = $lastMonthUsageArr != null && count($lastMonthUsageArr) > 0 ? $lastMonthUsageArr[0] : null;
//
//            // validation
//            if ($type == 'water') {
//                if (($lastMonthUsage != null && $currentReading <= $lastMonthUsage->water_new)
////                    || ($lastUsage != null && $currentReading <= $lastUsage->water_new )
//                ) {
//                    $data = array('error' => true, 'message' => "Water : The current number must be greater than previous number");
//                    return json_encode($data);
//                }
//            } else {
//                if (($lastMonthUsage != null && $currentReading <= $lastMonthUsage->electric_new)
////                    || ($lastUsage != null && $currentReading <= $lastUsage->electric_new && )
//                ) {
//                    $data = array('error' => true, 'message' => "Electric : The current number must be greater than previous number");
//                    return json_encode($data);
//                }
//            }
//            // end validation
//
//
//            if ($lastUsage == null) {
//                $usage = new Usage();
//                $usage->start_date = $lastMonthUsage != null ? $lastMonthUsage->end_date : $currentDate;
//                $usage->room_id = $room_id;
//                $usage->is_paid = false;
//                $usage->end_date = $currentDate;
//                $usage->price_setting_id = $price_setting->id;
//
//                if ($type == 'water') {
//                    $usage->water_new = $currentReading;
//                    $usage->water_old = $lastMonthUsage != null ? $lastMonthUsage->water_new : 0;
//                } else {
//
//                    $usage->electric_new = $currentReading;
//                    $usage->electric_old = $lastMonthUsage != null ? $lastMonthUsage->electric_new : 0;
//                }
//                $usage->save();
//            } else {
//                if ($type == 'water') {
//                    if ($lastUsage->water_new != null && $lastUsage->water_new != 0) {
//                        die("die3");
//                        $lastUsage->water_old = $lastUsage->water_new;
//                    } else if($lastMonthUsage != null && $lastMonthUsage->water_new != 0) {
//                        die("die4");
//                        $lastUsage->water_old = $lastMonthUsage->water_new;
//                    }
//                    $lastUsage->water_new = $currentReading;
//                } else {
//                    if ($lastUsage->electric_new != null && $lastUsage->electric_new != 0) {
//                        die("die1");
//                        $lastUsage->electric_old = $lastUsage->electric_new;
//                    } else if($lastMonthUsage != null && $lastMonthUsage->electric_new != 0) {
//                        die("die2");
//                        $lastUsage->electric_old = $lastMonthUsage->electric_new;
//                    }
//
//                    $lastUsage->electric_new = $currentReading;
//                }
//
//                $lastUsage->save();
//            }
//
//            $data = array('error' => false, 'message' => "Successfully");
//            return json_encode($data);
//        }
//        else {
//            $data = array('error' => true, 'message' => "Room is invalid.");
//            return json_encode($data);
//        }
    }

    private function getlastMonthRecord($roomId, $firstDate, $lastDate) {

        $strSql = "SELECT * FROM usages ";
        $strSql .= "WHERE (usages.room_id = ? ";
        $strSql .= "AND usages.end_date >= ? ";
        $strSql .= "AND usages.end_date <= ?) ";
//        $strSql .= "OR (usages.is_paid = true AND usages.room_id = ?) ";
        return DB::select($strSql, [$roomId, $firstDate, $lastDate]);

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
        //
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

    public function sendingInvoice($id) {

        $strSql = "SELECT DISTINCT users.* ";
        $strSql .= "FROM users ";
        $strSql .= "INNER JOIN rooms on users.room_id = rooms.id ";
        $strSql .= "INNER JOIN usages on usages.room_id = rooms.id ";
        $strSql .= "WHERE rooms.is_active = ? and users.is_active = ? ";
        $strSql .= "AND usages.id = ?";

        $user = DB::select($strSql, [1, 1, false, $id])->first();
        var_dump($user);die();

        Mail::to($user->email)->send(new SendInvoice($id));

        $usage = Usage::find($id);
        $usage->is_invoiced = true;
        $usage->save();

        return $this->viewIndex();

    }

    public function setPaid($id) {

        $usage = Usage::find($id);
//
//        $usage->paid_date = $usage->is_paid == true ? null : date("Y-m-d H:i:s");
//        $usage->is_paid = $usage->is_paid == true ? false : true;
//        $usage->save();

//        return $this->viewIndex();
        return view('admin.invoice.paidDialog', compact('usage'));
    }

    private function viewIndex() {
        if (Auth::user()->hasRole('admin')) {
            $strSql = "SELECT DISTINCT usages.* ";
            $strSql .= "FROM users ";
            $strSql .= "INNER JOIN rooms on users.room_id = rooms.id ";
            $strSql .= "INNER JOIN usages on usages.room_id = rooms.id ";
            $strSql .= "INNER JOIN role_user on users.id = role_user.user_id ";
            $strSql .= "INNER JOIN roles on roles.id = role_user.role_id ";
            $strSql .= "WHERE rooms.is_active = ? and users.is_active = ? ";
            $strSql .= "AND roles.is_staff = ? and users.created_by = ? ";
        } else {
            $strSql = "SELECT DISTINCT usages.* ";
            $strSql .= "FROM users ";
            $strSql .= "INNER JOIN rooms on users.room_id = rooms.id ";
            $strSql .= "INNER JOIN usages on usages.room_id = rooms.id ";
            $strSql .= "INNER JOIN role_user on users.id = role_user.user_id ";
            $strSql .= "INNER JOIN roles on roles.id = role_user.role_id ";
            $strSql .= "WHERE rooms.is_active = ? and users.is_active = ? ";
            $strSql .= "AND roles.is_staff = ? && users.id = ?";


        }
        $usages = DB::select($strSql, [1, 1, false, Auth::user()->getAuthIdentifier()]);

        $outstandingNum = count($this->getOutStandingList());
        $consumptionNum = count($this->getConsumptionList());

        return view('admin.usage.index', compact(['usages', 'outstandingNum', 'consumptionNum']));
    }

    public function getReports() {

        $consumptions = $this->getConsumptionList();
        $outstandings = $this->getOutStandingList();

        $outstandingNum = count($outstandings);
        $consumptionNum = count($consumptions);

        return view ('admin.usage.report', compact(['consumptions', 'outstandings', 'outstandingNum', 'consumptionNum']));
    }

    public function getCurrentRoom(){
        $rooms = DB::table('lease_settings')
            ->join('leases', 'leases.id', '=', 'lease_settings.lease_id')
            ->join('rooms', 'rooms.id', '=', 'leases.room_id')
            ->join('price_setting', 'price_setting.created_by', '=', 'rooms.created_by')
            ->select('rooms.room_number', 'rooms.size', 'lease_settings.end_date', 'lease_settings.room_price','lease_settings.is_active', 'price_setting.unit_supply')
            ->where('lease_settings.start_date', '<=', date("Y-m-d H:i:s"))
            ->where('lease_settings.end_date', '>=', date("Y-m-d H:i:s"))
            ->where('lease_settings.is_active', '=', 1)
            ->where('leases.is_active', '=', 1)
            ->get();
        return response()->json($rooms);
    }
}
