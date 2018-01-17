<?php

namespace App\Http\Controllers;

use App\Building;
use App\InvoiceComment;
use App\LeaseSetting;
use App\Maintenance;
use App\Payment;
use Illuminate\Http\Request;
use App\Mail\SendInvoice;
use App\PriceSetting;
use App\Usage;
use App\Room;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Illuminate\Support\Facades\Auth;
use App\Libs\Helpers;

class InvoiceController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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


    public function view(Request $request)
    {
        $invoiceType = $request->invoiceType;
        $id = $request->usage_id;
        $isPDF = true;
        list($usage, $room, $priceSetting, $user, $date, $invoiceNumber, $building, $invoiceComment, $payment, $maintenances) = $this->getInvoiceData($id);

        return view("admin.invoice.view", compact(['usage', 'room', 'priceSetting', 'user', 'invoiceNumber', 'date', 'isPDF', 'building', 'invoiceComment', 'payment', 'invoiceType', 'maintenances']));
    }

    public function download($id, $invoiceType)
    {
        list($usage, $room, $priceSetting, $user, $date, $invoiceNumber, $building, $invoiceComment, $payment, $maintenances) = $this->getInvoiceData($id);

        view()->share(compact(['usage', 'room', 'priceSetting', 'user', 'date', 'invoiceNumber', 'building', 'invoiceComment', 'payment', 'invoiceType', 'maintenances']));
        $fileName = 'Invoice_' . 'Room' . $room->room_number . '_' . date('M_Y') . '.pdf';

        $usage = Usage::find($id);
        $usage->is_downloaded = true;
        $usage->save();

        $pdf = PDF::loadView('admin.invoice.invoiceContent');
        return $pdf->download($fileName);
    }

    public function displayPaymentDialog($id) {
        $isPaymentDialog = true;

        list($usage, $room, $priceSetting, $user, $date, $invoiceNumber, $building, $invoiceComment, $payment, $maintenances) = $this->getInvoiceData($id);

        $water_usage = $usage->water_new - $usage->water_old;
        $electric_usage = $usage->electric_new - $usage->electric_old;

        $totalElectricCost = Helpers::getElectricPricePayment($priceSetting->electric_supply, $electric_usage);
        $totalWaterCost = Helpers::getWaterPricePayment($priceSetting->water_supply, $water_usage);
        list($numberOfDays, $numberOfRentDays, $totalRoomCost) = Helpers::getRoomPricePayment($priceSetting->unit_supply, $room->size, $usage->start_date, $usage->start_date);
        return view('admin.invoice.popupDialog', compact(['usage', 'isPaymentDialog', 'payment', 'totalRoomCost', 'totalElectricCost', 'totalWaterCost']));
    }

    public function paid(Request $request) {
        $usage = Usage::find($request->usage_id);

        $payment = Payment::where('usage_id', $request->usage_id)->first();
        if ($payment == null) {
            $payment = new Payment();
            $payment->usage_id = $usage->id;
        }

        $waterUsage = $usage->water_new - $usage->water_old;
        $electricUsage = $usage->electric_new - $usage->electric_old;

        $priceSetting = PriceSetting::find($usage->price_setting_id);
        $room = Room::find($usage->room_id);
        list($numberOfDays, $numberOfRentDays, $totalRoomCost) = Helpers::getRoomPricePayment($priceSetting->unit_supply, $room->size, $usage->start_date, $usage->start_date);
        $totalElectricPaid = Helpers::getElectricPricePayment($electricUsage, $priceSetting->electric_supply);
        $totalWaterPaid = Helpers::getElectricPricePayment($waterUsage, $priceSetting->water_supply);

        $isElectricPaid = $request->is_electric_paid != null ? $request->is_electric_paid : false;
        $isWaterPaid = $request->is_water_paid != null ? $request->is_water_paid : false;
        $isRoomPaid = $request->is_room_paid != null ? $request->is_room_paid : false;
        $currentDate = date("Y-m-d H:i:s");

        $payment->is_electric_paid = $isElectricPaid;
        $payment->is_water_paid = $isWaterPaid;
        $payment->is_room_paid = $isRoomPaid;

        $payment->paid_electric = $isElectricPaid ?  $totalElectricPaid : 0;
        $payment->paid_water = $isWaterPaid ?  $totalWaterPaid : 0;
        $payment->paid_room = $isRoomPaid ? $totalRoomCost : 0;

        $payment->electric_paid_date = $isElectricPaid ? $currentDate : null;
        $payment->water_paid_date = $isWaterPaid ? $currentDate : null;
        $payment->room_paid_date = $isRoomPaid ? $currentDate : null;

        $payment->save();

        $usage->is_paid = ($payment->is_electric_paid || $totalElectricPaid == 0)  && ($payment->is_water_paid || $totalWaterPaid == 0) && ($payment->is_room_paid || $isRoomPaid == 0);
        $usage->save();

        return json_encode('success');
    }

    public function paidInvoiceByUsageType($id, $usageType) {
        $usage = Usage::find($id);

        $payment = Payment::where('usage_id', $id)->first();
        if ($payment == null) {
            $payment = new Payment();
            $payment->usage_id = $usage->id;
        }

        $waterUsage = $usage->water_new - $usage->water_old;
        $electricUsage = $usage->electric_new - $usage->electric_old;

        $priceSetting = PriceSetting::find($usage->price_setting_id);
        $room = Room::find($usage->room_id);
        list($numberOfDays, $numberOfRentDays, $totalRoomCost) = Helpers::getRoomPricePayment($priceSetting->unit_supply, $room->size, $usage->start_date, $usage->start_date);

        if ($usageType == 'water') {
            $payment->is_water_paid = $payment != null && $payment->is_water_paid == true ? false : true;
        } elseif ($usageType == 'electric') {
            $payment->is_electric_paid = $payment != null && $payment->is_electric_paid == true ? false : true;
        }

        $payment->save();

        if ($payment->is_electric_paid && $payment->is_water_paid && $payment->is_room_paid) {
            $usage->is_paid = true;
            $usage->save();
        }

        return json_encode('success');
    }

    public function downloadInvoiceByUsageType($id, $usageType){
        list($usage, $room, $priceSetting, $user, $date, $invoiceNumber, $building, $invoiceComment, $payment, $maintenances) = $this->getInvoiceData($id);
        if ($usageType == 'water') {
            $invoiceType = $payment != null && $payment->is_water_paid ? 1 : 2;
        } elseif ($usageType == 'electric') {
            $invoiceType = $payment != null && $payment->is_electric_paid ? 1 : 2;
        }

        view()->share(compact(['usage', 'room', 'priceSetting', 'user', 'date', 'invoiceNumber', 'building', 'invoiceComment', 'payment', 'invoiceType', 'usageType', 'maintenances']));
        $fileName = 'Invoice_' . 'Room' . $room->room_number . '_' . date('M_Y') . '.pdf';

        $usage = Usage::find($id);
        $usage->is_downloaded = true;
        $usage->save();

        $pdf = PDF::loadView('admin.invoice.invoiceContent');
        return $pdf->download($fileName);
    }

    public function displayIndividualInvoice($id, $usageType) {
        $isPDF = true;
        list($usage, $room, $priceSetting, $user, $date, $invoiceNumber, $building, $invoiceComment, $payment, $maintenances) = $this->getInvoiceData($id);
        if ($usageType == 'water') {
            $invoiceType = $payment != null && $payment->is_water_paid ? 1 : 2;
        } elseif ($usageType == 'electric') {
            $invoiceType = $payment != null && $payment->is_electric_paid ? 1 : 2;
        }
        return view("admin.invoice.view", compact(['usage', 'room', 'priceSetting', 'user', 'invoiceNumber', 'date', 'isPDF', 'building', 'invoiceComment', 'payment', 'invoiceType', 'usageType', 'maintenances']));
    }

    public function displayInvoiceDialog($id) {
        $isPaymentDialog = false;
        list($usage, $room, $priceSetting, $user, $date, $invoiceNumber, $building, $invoiceComment, $payment, $maintenances) = $this->getInvoiceData($id);
        $water_usage = $usage->water_new - $usage->water_old;
        $electric_usage = $usage->electric_new - $usage->electric_old;

        $totalElectricCost = Helpers::getElectricPricePayment($priceSetting->electric_supply, $electric_usage);
        $totalWaterCost = Helpers::getWaterPricePayment($priceSetting->water_supply, $water_usage);
        list($numberOfDays, $numberOfRentDays, $totalRoomCost) = Helpers::getRoomPricePayment($priceSetting->unit_supply, $room->size, $usage->start_date, $usage->start_date);

        if(!isset($payment) || $payment == null) {
            $isPDF = true;
            $invoiceType = 2;
            return view("admin.invoice.view", compact(['usage', 'room', 'priceSetting', 'user', 'invoiceNumber', 'date', 'isPDF', 'building', 'invoiceComment', 'payment', 'invoiceType', 'maintenances']));
        }
        else {
            $isAllPaid = ($payment->is_electric_paid || $totalElectricCost == 0) && ($payment->is_water_paid || $totalWaterCost == 0) && ($payment->is_room_paid || $totalRoomCost == 0);
            if ($isAllPaid || ((!$payment->is_electric_paid || $totalElectricCost == 0) && (!$payment->is_water_paid || $totalWaterCost == 0) && (!$payment->is_room_paid || $totalRoomCost == 0))) {
                $isPDF = true;
                $invoiceType = $isAllPaid ? 1 : 2;
                return view("admin.invoice.view", compact(['usage', 'room', 'priceSetting', 'user', 'invoiceNumber', 'date', 'isPDF', 'building', 'invoiceComment', 'payment', 'invoiceType', 'maintenances']));
            }
        }

        return view('admin.invoice.popupDialog', compact(['usage', 'isPaymentDialog', 'payment', 'totalRoomCost', 'totalElectricCost', 'totalWaterCost']));
    }

    public function send($id) {
        $strSql = "SELECT users.* ";
        $strSql .= "FROM users ";
        $strSql .= "INNER JOIN rooms on users.room_id = rooms.id ";
        $strSql .= "INNER JOIN usages on usages.room_id = rooms.id ";
        $strSql .= "WHERE rooms.is_active = ? and users.is_active = ? ";
        $strSql .= "AND usages.id = ?";

        $user = DB::select($strSql, [1, 1, $id]);
        if ($user != null && count($user) > 0) {
            Mail::to($user[0]->email)->send(new SendInvoice($id));

            $usage = Usage::find($id);
            $usage->is_invoiced = true;
            $usage->save();

        } else {
            throw new \ErrorException('404');
        }

    }

    public function saveComment(Request $request) {
        $usageId = $request['usage_id'];

        $invoiceComment = InvoiceComment::where('usage_id', $usageId)->first();
        if ($invoiceComment == null) {
            $invoiceComment = new InvoiceComment();
            $invoiceComment->usage_id = $usageId;
        }
        $invoiceComment->comments = trim(htmlentities($request['invoice-comment']));
        $invoiceComment->save();

        $data = array('comments' => $request['invoice-comment']);
        return json_encode($data);
    }

    private function getBuilding() {

        if (Auth::user()->hasRole('admin')) {
            $createdUser = Auth::user()->getAuthIdentifier();
        } else {
            $user = User::find(Auth::user()->getAuthIdentifier());
            $createdUser = $user->create_by;
        }

        return Building::where('created_by', $createdUser)->where('is_active', true)->first();
    }

    private function getInvoiceComment($usageId) {
        return InvoiceComment::where('usage_id', $usageId)->first();
    }


    private function getInvoiceData($id) {
        $usage = Usage::find($id);
        $room = Room::find($usage->room_id);
        $createdUserId = Auth::user()->hasRole('admin') ? Auth::user()->getAuthIdentifier() : Auth::user()->created_by;

        $priceSetting = Helpers::getCurrentPricesByUsage($usage);

        $user = User::all()->where('room_id', $room->id)->first();
        $date = date('d/m/Y');
        $time = strtotime($usage->start_date);
        $invoiceNumber = $room->room_number . '-' . date('m-y',$time);

        $building = $this->getBuilding();
        $invoiceComment = $this->getInvoiceComment($usage->id);
        $payment = Payment::where('usage_id', $usage->id)->first();

        $currentDate = date("Y-m-d H:i:s");
        $maintenances = Maintenance::all()->where('room_id', $room->id)->where('start_date', '<=', $currentDate)->where('end_date', '<=', $currentDate)->where('status', 'done');

        return array($usage, $room, $priceSetting, $user, $date, $invoiceNumber, $building, $invoiceComment, $payment, $maintenances);

    }
}
