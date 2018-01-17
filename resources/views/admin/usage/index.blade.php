<!-- index.blade.php -->
<?php
use App\Libs\Helpers;
?>
@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Home</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li class="active">
                Home
            </li>
        </ol>
        </p>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading font-14">
                    <i class="fa fa-list panel-ico"></i>
                    <span class="panel-title" data-toggle="modal" data-target="#add">Invoice</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Room#</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Balance</th>
                                <th>Start date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usages as $usage)
                                <?php
                                $room = DB::table('rooms')->where('id', $usage->room_id)->first();
                                $user = DB::table('users')->where('room_id', $usage->room_id)->first();
                                $payment = DB::table('payments')->where('usage_id', $usage->id)->first();
                                $priceSetting = Helpers::getCurrentPricesByUsage($usage);

                                $totalRemainingAmount = 0;
                                $water_usage = $usage->water_new - $usage->water_old;

                                $electric_usage = $usage->electric_new - $usage->electric_old;

                                $totalElectricCost = Helpers::getElectricPricePayment($priceSetting->electric_supply, $electric_usage);
                                $totalWaterCost = Helpers::getWaterPricePayment($priceSetting->water_supply, $water_usage);

                                if((isset($payment) && $payment->is_water_paid == false)  || $payment == null) {
                                    $water_usage = $usage->water_new - $usage->water_old;
                                    $totalRemainingAmount += Helpers::getWaterPricePayment($priceSetting->water_supply, $water_usage);
                                }
                                if ((isset($payment) && $payment->is_electric_paid == false) || $payment == null) {
                                    $electric_usage = $usage->electric_new - $usage->electric_old;
                                    $totalRemainingAmount += Helpers::getElectricPricePayment($priceSetting->electric_supply, $electric_usage);
                                }
                                if ((isset($payment) && $payment->is_room_paid == false) || $payment == null) {
                                    list($numberOfDays, $numberOfRentDays, $totalRoomCost) = Helpers::getRoomPricePayment($priceSetting->unit_supply, $room->size, $usage->start_date, $usage->start_date);
                                    $totalRemainingAmount += $totalRoomCost;
                                }

                                ?>
                            <tr>
                                <td>{{$room->room_number}}</td>
                                <td><a href="/user/customerprofile/{{$user->id}}/false">{{$user->first_name}} {{$user->last_name}}</a></td>
                                <td>{{$user->contact_number}}</td>
                                <td>{{$totalRemainingAmount}}</td>
                                <td>{{$usage->start_date != null ? \App\Libs\DateHelpers::formatDefaultDate($usage->start_date) : ''}}</td>
                                <td class="focus">
                                    <div class="text-center">
                                        <div class="btn-group">
                                            @if((!isset($payment) || $payment == null ) || (isset($payment) && $payment != null) && (($payment->is_electric_paid && $payment->is_water_paid && $payment->is_room_paid) || (!$payment->is_electric_paid && !$payment->is_water_paid && !$payment->is_room_paid) || $totalRemainingAmount == 0))
                                                <a href="/invoice/displayinvoicedialog/{{$usage->id}}" class="btn btn-default btn-bordered waves-effect w-md m-r-10">Invoice</a>
                                            @else
                                                <a href="/invoice/displayinvoicedialog/{{$usage->id}}" class="btn btn-default btn-bordered waves-effect w-md m-r-10 edit-row" data-toggle="modal" data-target="#edit">Invoice</a>
                                            @endif
                                            @if(Auth::user()->hasRole('admin') || Auth::user()->can('paid_invoice'))
                                                @if($usage->is_paid == true || $totalRemainingAmount == 0)
                                                <a href="/invoice/displaypaymentdialog/{{$usage->id}}" class="btn btn-warning btn-bordered waves-effect w-md waves-light edit-row" data-toggle="modal" data-target="#edit">Paid</a>
                                                @else
                                                <a href="/invoice/displaypaymentdialog/{{$usage->id}}" class="btn btn-danger btn-bordered waves-effect w-md waves-light edit-row" data-toggle="modal" data-target="#edit">Unpaid</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

