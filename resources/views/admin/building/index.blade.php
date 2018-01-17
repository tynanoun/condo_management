@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Building</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li class="active">
                Building
            </li>
        </ol>
        </p>
    </div>
@endsection

@section('content')
    <?php
    $buildingName = "";
    $location = "";
    $ownerName = "";
    $contractNumber = "";
    $roomCapacity = "";
    $propertyManager = "";
    $officeEmail = "";
    $officeNumber = "";
    $invoiceComment = "";
    $isActive = "";
    $isEditable = Auth::user()->hasRole('admin') || Auth::user()->can('buildingEdit');
            ?>
<div class="row">
    <div class="col-lg-12">
        <div class="bg">
            <ul class="nav nav-tabs tabs-bordered">
                <li class="active">
                    <a href="#building" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-calendar"></i></span>
                        <span class="hidden-xs">Building Info</span>
                    </a>
                </li>
                <li class="">
                    <a href="#invoice" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-calendar"></i></span>
                        <span class="hidden-xs">Invoice</span>
                    </a>
                </li>
            </ul>
        </div>
        @if(isset($building) && $building != null)
            <form class="form-horizontal customer-form" method="POST" action="{{action('BuildingController@update', $building->id)}}">
                <?php
                $buildingName = $building->building_name;
                $location = $building->location;
                $ownerName = $building->owner_name;
                $contractNumber = $building->contract_number;
                $roomCapacity = $building->room_capacity;
                $propertyManager = $building->property_manager;
                $officeEmail = $building->property_manager;
                $officeNumber = $building->office_number;
                $invoiceComment = $building->invoice_comment;
                $isActive = $building->is_active;
                ?>
        @else
            <form class="form-horizontal customer-form" method="POST" action="{{url('building')}}">
                @endif
        <div class="card-box">
            <div class="tab-content">
                <div class="tab-pane active" id="building">

                        {{ csrf_field() }}
                    @if(isset($building) && $building != null)
                    <input name="_method" type="hidden" value="PATCH">
                    @endif

                    <div class="row m-b-30">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Building name</label>
                                            <input type="input" name="building_name" class="form-control" id="building_name" value="{{$buildingName}}" placeholder="Building name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Location</label>
                                            <input type="input" name="location" class="form-control" id="location" value="{{$location}}" placeholder="Location">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Owner Name</label>
                                            <input type="input" name="owner_name" class="form-control" id="owner_name" value="{{$ownerName}}" placeholder="Owner Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Contact Number</label>
                                            <input name="contract_number" id="contract_number" type="input" class="form-control" value="{{$contractNumber}}" placeholder="Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Room Capacity</label>
                                            <input type="input" name="room_capacity" id="room_capacity" class="form-control" value="{{$roomCapacity}}" placeholder="Room Capacity">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Property Manager</label>
                                            <input type="input" class="form-control" id="property_manager" name="property_manager" value="{{$propertyManager}}" placeholder="Property Manager">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Office Email</label>
                                            <input type="input" class="form-control" id="office_email" name="office_email" value="{{$officeEmail}}" placeholder="Office Email">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Office Number</label>
                                            <input type="input" class="form-control" id="office_number" name="office_number" placeholder="Office Number">
                                        </div>
                                    </div>

                                    @if($isEditable)
                                    <div class="col-sm-12">
                                        <button class="btn btn-danger waves-effect waves-light" type="submit">
                                            Save
                                        </button>
                                    </div>
                                        @endif
                                </div>

                            </div> <!-- card-box -->
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="invoice">
                    <div class="row" id="HTMLtoPDF">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-xs-8 ">
                                        <div class="form-group">
                                            <label>Invoice</label>
                                            <textarea class="form-control print-clean" rows="6" name="invoice_comment" id="invoice_comment">
                                                {{$invoiceComment}}
                                            </textarea>
                                        </div>
                                    </div>
                                    @if($isEditable)
                                    <div class="col-sm-12">
                                        <button class="btn btn-danger waves-effect waves-light" type="submit">
                                            Save
                                        </button>
                                    </div>
                                        @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

</div>

@endsection