@if(!isset($isPDF))
    <style>
        <?php include(public_path().'/assets/css/bootstrap.min.css');?>

    </style>

    <script>
        <?php include(public_path().'/assets/js/bootstrap.min.js')?>
    </script>
@else
    <style>
        .print-clean {
            border: none;
            background: transparent;
            overflow: hidden;
            outline: none;
            resize: none;
        }
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
        @media print {
            .clearfix{
                margin-top: 30px;
            }
        }

    </style>
@endif
<?php
use App\Libs\Helpers;
use App\Libs\DateHelpers;
?>
<div class="row" id="HTMLtoPDF">
    <div class="col-md-12">
        <div class="card-box">
            <div class="clearfix">
                <div class="pull-left">
                    @if(!isset($isPDF))
                        <img src="assets/images/logo.png" alt="" height="40">
                     @else
                        <img src="/assets/images/logo.png" alt="" height="40">
                    @endif
                </div>
                <div class="text-center">
                    <h3 class="m-0">Contract</h3>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-6">
                    <div class="pull-left m-t-30">

                    </div>

                </div><!-- end col -->
                <div class="col-sm-3 col-sm-offset-3 col-xs-offset-2">
                    <div class="pull-right">
                        <p><small><strong>Date: </strong></small><?php echo DateHelpers::formatDefaultDate(date("Y-m-d H:i:s"))?></p>
                        <p><small><strong>Contact N<sup>o</sup>: </strong></small>{{$contactNumber}}</p>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
            <div class="row m-t-30">
            </div>
            <div class="row m-t-30">
                <div class="col-xs-4">
                    <h5>Room Number</h5>

                    <address class="line-h-24">
                        {{$room->room_number}}
                    </address>

                </div>

                <div class="col-xs-4">
                    <h5>Room Size</h5>

                    <address class="line-h-24">
                        {{$room->size}} M<sup>2</sup>
                    </address>

                </div>

                <div class="col-xs-4">
                    <h5>Room description</h5>

                    <address class="line-h-24">
                        {{$room->description}}
                    </address>

                </div>
            </div>

            @if(isset($lease) && $lease != null)
            <div class="row m-t-30">
                <div class="col-xs-4">
                    <h5>Start Water Reading</h5>

                    <address class="line-h-24">
                        {{$lease->start_current_reading_water}} M<sup>3</sup>
                    </address>

                </div>
                <div class="col-xs-4">
                    <h5>Start Electric Reading</h5>
                    <address class="line-h-24">
                        {{$lease->start_current_reading_electric}} KWH
                    </address>

                </div>
            </div>
            @endif

            @if (isset($priceSetting) && $priceSetting != null)
            <h5>Default Price</h5>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table m-t-30">
                            <thead>
                            <tr><th>Room/m<sup>2</sup></th>
                                <th>Electric/KWH</th>
                                <th>Water/m<sup>3</sup></th>
                            </tr></thead>
                            <tbody>
                            <tr>
                                <td><?php echo Helpers::formatAmountToUS($priceSetting->unit_supply)?></td>
                                <td><?php echo Helpers::formatAmountToUS($priceSetting->electric_supply)?></td>
                                <td><?php echo Helpers::formatAmountToUS($priceSetting->water_supply)?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            @if(isset($leaseSettings) && $leaseSettings != null)
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table m-t-30">
                            <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date </th>
                                    <th>Room Price </th>
                                    <th>Water Price </th>
                                    <th>Electric Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaseSettings as $leaseSetting)
                                <tr>
                                    <td><?php echo DateHelpers::formatDefaultDate(date("Y-m-d H:i:s", strtotime($leaseSetting->start_date)))?></td>
                                    <td><?php echo DateHelpers::formatDefaultDate(date("Y-m-d H:i:s", strtotime($leaseSetting->end_date)))?></td>
                                    <td><?php echo $leaseSetting->room_price != null && $leaseSetting->room_price > 0 ? Helpers::formatAmountToUS($leaseSetting->room_price) : Helpers::formatAmountToUS($priceSetting->unit_supply)?></td>
                                    <td><?php echo $leaseSetting->water_price != null && $leaseSetting->water_price > 0 ? Helpers::formatAmountToUS($leaseSetting->water_price) : Helpers::formatAmountToUS($priceSetting->water_supply)?></td>
                                    <td><?php echo $leaseSetting->electic_price != null && $leaseSetting->electric_price > 0 ? Helpers::formatAmountToUS($leaseSetting->electric_price) : Helpers::formatAmountToUS($priceSetting->electric_supply)?></td>
                                </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            <br/><br/><br/><br/><br/>

            <div class="row">
                <div class="col-xs-8 ">
                    <b><u>Signature</u></b>
                    <br/><br/><br/><br/><br/><br/>
                    <p>Name: {{$userName}}</p>
                    <p>Date: <?php echo DateHelpers::formatDefaultDate(date("Y-m-d H:i:s"))?></p>
                </div>
                <div class="col-xs-4" >
                    <b><u>Signature</u></b>
                    <br/><br/><br/><br/><br/><br/>
                    <p>Name : {{$ownerName}}</p>
                    <p>Date: <?php echo DateHelpers::formatDefaultDate(date("Y-m-d H:i:s"))?></p>
                </div>
            </div>
            {{--</form>--}}
            @if(isset($isPDF))
            <div class="hidden-print m-t-30 m-b-30" style="position: fixed; bottom: 10px; width: 350px; right: 18px;">
                <div class="text-right">
                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                    {{--@if(isset($usageType))--}}
                    <button  class="btn default " id="btn-contract-download" onclick="downloadContract()" data-url="\contract\download\{{$room->id}}"><i class="fa fa-download m-r-5" aria-hidden="true"></i>Download</button>
                    {{--@else--}}

                    {{--@endif--}}
                </div>
            </div>
            @endif

        </div>

    </div>

</div>

<script type="text/javascript">

    function sendInvoice() {
        window.location.href = document.getElementById("btn-invoice-send").getAttribute("data-url");
    }

    function downloadContract() {
        window.location.href = document.getElementById("btn-contract-download").getAttribute("data-url");
    }

</script>