<?php

namespace App\Http\Controllers;

use App\Building;
use App\Lease;
use App\LeaseSetting;
use App\Libs\Helpers;
use App\PriceSetting;
use App\Room;
use App\User;
use PDF;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $rooms = Helpers::getRoomOfCurrentUser();

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
    public function show($roomId)
    {

        //
    }

    public function view($roomId) {
        $isPDF = false;
        list($room, $lease, $leaseSettings, $priceSetting, $contactNumber, $ownerName, $userName) = $this->generateContractData($roomId);
        return view('admin.contract.index', compact(['isPDF', 'room', 'lease', 'leaseSettings', 'priceSetting', 'contactNumber', 'ownerName', 'userName']));
    }

    public function download($roomId)
    {

        list($room, $lease, $leaseSettings, $priceSetting, $contactNumber, $ownerName, $userName) = $this->generateContractData($roomId);

        view()->share(compact(['room', 'lease', 'leaseSettings', 'priceSetting', 'contactNumber', 'ownerName', 'userName']));
        $fileName = 'contract_' . 'Room' . $room->room_number . '_' . date('M_Y') . '.pdf';
//
//        $usage = Usage::find($id);
//        $usage->is_downloaded = true;
//        $usage->save();

        $pdf = PDF::loadView('admin.contract.ContractContent');
        return $pdf->download($fileName);
    }

    private function generateContractData($roomId) {

        $room = Room::all()->where('is_active', true)->where('id', $roomId)->first();
        $lease = Lease::all()->where('is_active', true)->where('room_id', $room->id)->first();
        $leaseSettings = null;
        if (isset($lease) && $lease != null) {
            $leaseSettings = LeaseSetting::all()->where('lease_id', $lease->id)->where('is_active', true);
        }
        $user = User::all()->where('room_id', $room->id)->where('is_active', true)->first();
        $userName = '';
        $contactNumber = '';

        if (isset($user) && $user != null) {
            $userName = isset($user) && $user != null ? ($user->first_name . ' ' . $user->last_name) : '';
            $contactNumber = 'C-' . $room->room_number . '-' . date('m-y', strtotime($user->start_date));
        }

        $priceSetting = PriceSetting::all()->where('is_active', true)->where('created_by', $room->created_by)->first();
        $building = Building::all()->where('created_by', $room->created_by)->first();
        $ownerName = isset($building) && $building != null ? $building->owner_name : '';



        return array($room, $lease, $leaseSettings, $priceSetting, $contactNumber, $ownerName, $userName);
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
}
