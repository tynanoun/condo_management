<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
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

    public function displayPaymentDialog($id) {
        $usage = Usage::find($id);
        $isPaymentDialog = true;
        return view('admin.invoice.popupDialog', compact(['usage','isPaymentDialog']));
    }

    public function paid(Request $request) {
        $usage = Usage::find($request->usage_id);
        if ($usage != null && $usage->is_active) {
            $usage->is_electric_paid = $request->is_electric_paid;
            $usage->is_water_paid = $request->is_water_paid;
            $usage->is_room_paid = $request->is_room_paid;
            $usage->save();
            return json_encode('success');
        }
        return json_encode('error');
    }

    public function displayInvoiceDialog($id) {
        $usage = Usage::find($id);
        $isPaymentDialog = false;
        return view('admin.invoice.popupDialog', compact(['usage','isPaymentDialog']));
    }


}
