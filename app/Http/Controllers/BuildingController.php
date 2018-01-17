<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
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
        return $this->getActiveBuilding();
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
        $building = new Building();
        $building->building_name = $request['building_name'];
        $building->location = $request['location'];
        $building->owner_name = $request['owner_name'];
        $building->contract_number = $request['contract_number'];
        $building->room_capacity = $request['room_capacity'];
        $building->property_manager = $request['property_manager'];
        $building->property_manager = $request['property_manager'];
        $building->office_number = $request['office_number'];
        $building->invoice_comment = $request['invoice_comment'];
        $building->created_by = Auth::user()->getAuthIdentifier();

        $building->save();

        return $this->getActiveBuilding();
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
        $building = Building::find($id);

        $building->building_name = $request['building_name'];
        $building->location = $request['location'];
        $building->owner_name = $request['owner_name'];
        $building->contract_number = $request['contract_number'];
        $building->room_capacity = $request['room_capacity'];
        $building->property_manager = $request['property_manager'];
        $building->property_manager = $request['property_manager'];
        $building->office_number = $request['office_number'];
        $building->invoice_comment = $request['invoice_comment'];
        $building->created_by = Auth::user()->getAuthIdentifier();

        $building->save();

        return $this->getActiveBuilding();
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

    private function getActiveBuilding() {
        $building = Building::where('created_by', Auth::user()->getAuthIdentifier())->where('is_active', true)->first();
        return view('admin.building.index', compact('building'));
    }
}
