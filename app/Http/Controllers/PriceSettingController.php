<?php

namespace App\Http\Controllers;

use App\PriceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceSettingController extends Controller
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
        $outstandingNum = count($this->getOutStandingList());
        $consumptionNum = count($this->getConsumptionList());
        $priceSetting = PriceSetting::where('is_active', true)->where('created_by', Auth::user()->getAuthIdentifier())->first();
        return view('admin.pricesetting.index', compact(['priceSetting', 'outstandingNum', 'consumptionNum']));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.pricesetting.create');
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
        $priceSetting = new PriceSetting([
            'water_supply' => $request->get('water_supply'),
            'electric_supply' => $request->get('electric_supply'),
            'unit_supply' => $request->get('unit_supply'),
            'description' => $request->get('description'),
            'created_by' => Auth::user()->getAuthIdentifier()
        ]);

        $priceSetting->save();
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
        $priceSetting = PriceSetting::find($id)->where('is_active', true)->first();
        return view ('admin.pricesetting.edit', compact('priceSetting'));
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
        $price = PriceSetting::find($id)->where('is_active', true)->first();

        if($price != null) {
            $price->is_active = false;
            $price->save();

            $tmpPriceSetting = new PriceSetting([
                'water_supply' => $request->get('water_supply'),
                'electric_supply' => $request->get('electric_supply'),
                'unit_supply' => $request->get('unit_supply'),
                'description' => $request->get('description'),
                'created_by' => Auth::user()->getAuthIdentifier()
            ]);

            $tmpPriceSetting->save();
        }
        return json_encode("success");
//        $priceSetting = PriceSetting::where('is_active', true)->first();
//        return view('admin.pricesetting.index', compact('priceSetting'));
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
