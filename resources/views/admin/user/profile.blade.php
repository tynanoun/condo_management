<!-- index.blade.php -->
@extends('customermaster')
@section('content')
    <?php
    use App\Libs\DateHelpers;
    $room = DB::table('rooms')->where('id', $customer['room_id'])->first();
    ?>

    <div class="row m-b-30">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="{{$customer->first_name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="{{$customer->last_name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="{{$customer->contact_number}}" disabled>
                        </div>
                    </div>
                    @if(!$isStaff)
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Room Number</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="{{$room->room_number}}" disabled>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="{{$customer->email}}" disabled>
                        </div>
                    </div>
                </div>
            </div> <!-- card-box -->
        </div>
    </div>
@if(!$isStaff)
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg">
                        <ul class="nav nav-tabs tabs-bordered">
                            <li class="active">
                                <a href="#home-b1" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                    <span class="hidden-xs">Electricity</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#profile-b1" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                                    <span class="hidden-xs">Water</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-box">
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-b1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel-color panel-inverse">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-keytable" class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Previous Reading</th>
                                                            <th>Current Reading</th>
                                                            <th>Usage</th>
                                                            <th>Paid Date</th>
                                                            <th class="text-center" style="width:5%">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($usages as $usage)
                                                            <?php
                                                                    $usageElectric = $usage->electric_new - $usage->electric_old;
                                                            $payment = DB::table('payments')->where('usage_id', $usage->id)->first();
                                                            ?>
                                                        <tr>
                                                            <td>{{DateHelpers::formatDefaultDate($usage->start_date)}}</td>
                                                            <td>{{DateHelpers::formatDefaultDate($usage->end_date)}}</td>
                                                            <td>{{$usage->electric_old}}</td>
                                                            <td>{{$usage->electric_new}}</td>
                                                            <td>{{$usageElectric}}</td>
                                                            <td>{{isset($payment) && $payment != null ? DateHelpers::formatDefaultDate($payment->electric_paid_date) : ''}}</td>
                                                            <td class="focus">
                                                                <div class="text-center">
                                                                    <div class="btn-group">
                                                                        @if(Auth::user()->hasRole('admin') || Auth::user()->can('paid_invoice'))
                                                                            <a href="/invoice/displayindividualinvoice/{{$usage->id}}/electric" class="btn btn-default btn-bordered waves-effect w-md m-r-10">Invoice</a>
                                                                            @if(isset($payment) && $payment->is_electric_paid == true && (Auth::user()->hasRole('admin') || Auth::user()->can('paid_invoice')))
                                                                                <a href="/invoice/paidinvoicebyusagetype/{{$usage->id}}/electric" class="btn btn-warning btn-bordered waves-effect w-md waves-light paid-button">Paid</a>
                                                                            @else
                                                                                <a href="/invoice/paidinvoicebyusagetype/{{$usage->id}}/electric" class="btn btn-danger btn-bordered waves-effect w-md waves-light paid-button">Unpaid</a>
                                                                            @endif
                                                                        @endif
                                                                        
                                                                        {{--<a href="#" class="table-action-btn m-r-5" data-toggle="modal" data-target="#edit"> <i class="fa fa-book text-warning" aria-hidden="true"></i></a>--}}
                                                                        {{--<a href="#" class="table-action-btn m-r-5" data-toggle="modal" data-target="#edit"><i class="mdi mdi-arrow-down-bold-hexagon-outline text-danger"></i></a>--}}
                                                                        {{--<a href="#" class="table-action-btn" data-toggle="modal" data-target="#edit"><i class="mdi mdi-currency-usd widget-two-icon text-success"></i></a>--}}
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
                            </div>
                            <div class="tab-pane" id="profile-b1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel-color panel-inverse">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Start Date</th>
                                                            <th>End Date</th>
                                                            <th>Previous Reading</th>
                                                            <th>Current Reading</th>
                                                            <th>Usage</th>
                                                            <th>Paid Date</th>
                                                            <th class="text-center" style="width:5%">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($usages as $usage)
                                                            <?php
                                                            $usageWater = $usage->water_new - $usage->water_old;
                                                            $payment = DB::table('payments')->where('usage_id', $usage->id)->first();
                                                            ?>

                                                            <tr>
                                                                <td>{{DateHelpers::formatDefaultDate($usage->start_date)}}</td>
                                                                <td>{{DateHelpers::formatDefaultDate($usage->end_date)}}</td>
                                                                <td>{{$usage->water_old}}</td>
                                                                <td>{{$usage->water_new}}</td>
                                                                <td>{{$usageWater}}</td>
                                                                <td>{{isset($payment) && $payment != null ? DateHelpers::formatDefaultDate($payment->water_paid_date) : ''}}</td>
                                                                <td class="focus">
                                                                    <div class="text-center">
                                                                        <div class="btn-group">
                                                                            <a href="/invoice/displayindividualinvoice/{{$usage->id}}/water" class="btn btn-default btn-bordered waves-effect w-md m-r-10">Invoice</a>
                                                                            @if(isset($payment) && $payment->is_water_paid == true && (Auth::user()->hasRole('admin') || Auth::user()->can('paid_invoice')))
                                                                                <a href="/invoice/paidinvoicebyusagetype/{{$usage->id}}/water" class="btn btn-warning btn-bordered waves-effect w-md waves-light paid-button">Paid</a>
                                                                            @else
                                                                                <a href="/invoice/paidinvoicebyusagetype/{{$usage->id}}/water" class="btn btn-danger btn-bordered waves-effect w-md waves-light paid-button">Unpaid</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
