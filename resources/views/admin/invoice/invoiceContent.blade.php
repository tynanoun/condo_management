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
use NumberToWords\NumberToWords;
use App\Libs\Helpers;

if (isset($usage)) {
    $water_usage = $usage->water_new - $usage->water_old;

    $electric_usage = $usage->electric_new - $usage->electric_old;

    $totalElectricCost = Helpers::getElectricPricePayment($priceSetting->electric_supply, $electric_usage);
    $totalWaterCost = Helpers::getWaterPricePayment($priceSetting->water_supply, $water_usage);
    list($numberOfDays, $numberOfRentDays, $totalRoomCost) = Helpers::getRoomPricePayment($priceSetting->unit_supply, $room->size, $usage->start_date, $usage->start_date);
    // end the room price

    $subTotal = 0;
    $isDisplayWater = false;
    $isDisplayElectric = false;
    $isDisplayRoom = false;
    if (isset($payment) && $payment != null) {
        if (!isset($usageType)) {
            if (($invoiceType == 1 && $payment->is_water_paid == true) || ($invoiceType == 2 && $payment->is_water_paid == false)) {
                $subTotal += $totalWaterCost;
                $isDisplayWater = true;
            }
            if (($invoiceType == 1 && $payment->is_electric_paid == true) || ($invoiceType == 2 && $payment->is_electric_paid == false)) {
                $isDisplayElectric = true;
                $subTotal += $totalElectricCost;
            }
            if (($invoiceType == 1 && $payment->is_room_paid == true) || ($invoiceType == 2 && $payment->is_room_paid == false)) {
                $subTotal += $totalRoomCost;
                $isDisplayRoom = true;
            }
        } elseif ($usageType === 'water') {
            if (($invoiceType == 1 && $payment->is_water_paid == true) || ($invoiceType == 2 && $payment->is_water_paid == false)) {
                $subTotal += $totalWaterCost;
                $isDisplayWater = true;
            }
        } else {
            if (($invoiceType == 1 && $payment->is_electric_paid == true) || ($invoiceType == 2 && $payment->is_electric_paid == false)) {
                $isDisplayElectric = true;
                $subTotal += $totalElectricCost;
            }
        }
    } else {
        $subTotal += $totalWaterCost;
        $isDisplayWater = true;
        $isDisplayElectric = true;
        $subTotal += $totalElectricCost;
        $subTotal += $totalRoomCost;
        $isDisplayRoom = true;
    }

    $vat = 0;

    $total = Helpers::getTotalWithVAT($subTotal, $vat);

    $strTotal = Helpers::formatAmountToUS($total);
    $strSubTotal = Helpers::formatAmountToUS($subTotal);
    $amountInWords = Helpers::amountInWords($total);
    }
?>

{{--@if($isPDFDialog)--}}
<div class="row" id="HTMLtoPDF">
    <div class="col-md-12">
        <div class="card-box">
            <div class="clearfix">
                <div class="pull-left">
                    @if(isset($isPDF) && $isPDF)
                    <img src="/assets/images/logo.png" alt="" height="30">
                    @else
                    <img src="assets/images/logo.png" alt="" height="30">
                    @endif

                </div>
                <div class="pull-right">
                    <h3 class="m-0">Invoice</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="pull-left m-t-30">
                        <p><b>{{$user->first_name}} {{$user->last_name}}</b></p>
                        <p class="text-muted">{{$user->contact_number}}<br>
                            {{$user->email}}
                        </p>
                    </div>

                </div><!-- end col -->
                <div class="col-sm-3 col-sm-offset-3 col-xs-offset-2">
                    <div class="pull-right">
                        <p><small><strong>Date: </strong></small>{{$date}}</p>
                        <p><small><strong>Invoice No: </strong></small> {{$invoiceNumber}}</p>
                        <p><small><strong>Invoice Status: </strong></small><?php echo $invoiceType == 1 ? "Paid" : "Unpaid"?></p>
                        <p><small><strong>Period: </strong></small>{{$numberOfRentDays}} day(s)<br><small><strong>From: </strong></small>{{date("d-m-Y", strtotime($usage->start_date))}} <small><strong>To: </strong></small>{{date("d-m-Y", strtotime($usage->end_date))}}</p>

                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
            <div class="row m-t-30">
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table m-t-30">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Previous Reading </th>
                                <th>Current Reading </th>
                                <th>Usage </th>
                                <th>Unit Price USD </th>
                                <th class="text-right">Total</th>
                            </tr></thead>
                            <tbody>
                            @if($isDisplayElectric && $electric_usage > 0)
                            <tr>
                                <td class="td-wrap-word-30-percents"> Electric Usage </td>
                                <td> {{$usage->electric_old}} </td>
                                <td> {{$usage->electric_new}} </td>
                                <td> {{$electric_usage}} KWH </td>
                                <td> {{$priceSetting->electric_supply}} </td>
                                <td class="text-right"><?php echo Helpers::formatAmountToUS($totalElectricCost);?></td>
                            </tr>
                            @endif
                            @if ($isDisplayWater && $water_usage > 0)
                            <tr>
                                <td class="td-wrap-word-30-percents"> Water Usage </td>
                                <td> {{$usage->water_old}} </td>
                                <td> {{$usage->water_new}} </td>
                                <td> {{$water_usage}} M<sup>3</sup></td>
                                <td> {{$priceSetting->water_supply}} </td>
                                <td class="text-right"><?php echo Helpers::formatAmountToUS($totalWaterCost);?></td>
                            </tr>
                            @endif
                            @if ($isDisplayRoom && $totalRoomCost > 0)
                            <tr>
                                <td class="td-wrap-word-30-percents"> Room </td>
                                <td>  -----</td>
                                <td>  ----- </td>
                                <td> {{$room->size}} M<sup>2</sup></td>
                                <td> {{$priceSetting->unit_supply}}</td>
                                <td class="text-right"><?php echo Helpers::formatAmountToUS($totalRoomCost);?></td>
                            </tr>
                            @endif
                            @if ($isDisplayRoom && $totalRoomCost > 0 && isset($maintenances) && count($maintenances) > 0)
                                @foreach($maintenances as $maintenance)
                                <tr>
                                    <td class="td-wrap-word-30-percents"> {{$maintenance->task_name}} : {{$maintenance->description}} </td>
                                    <td> ----- </td>
                                    <td> ----- </td>
                                    <td> ----- </td>
                                    <td> ----- </td>
                                    <td class="text-right"> ----- </td>
                                </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="2" class="text-right"> <b>Sub-total:</b> {{$strSubTotal}}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="2" class="text-right"><b>VAT ({{$vat}}%):</b> {{$vat}}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="2" class="text-right"><b>Total:</b> {{$strTotal}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 ">
                    <div class="form-group">
                        <b>Amount in Words:</b> {{ucwords($amountInWords)}}
                    </div>
                </div>
            </div>
            <br><br>
            <form class="form-horizontal customer-form" method="POST" action="{{url('invoice/savecomment')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="usage_id" type="hidden" value="{{$usage->id}}">
            <div class="row">
                <div class="col-xs-8 ">
                    <div class="form-group">
                        <label>Payment Method</label>
                        @if(Auth::user()->hasRole('admin') || Auth::user()->can('editInvoiceComment'))
                        <textarea class="form-control invoice-comment" rows="6" name="invoice-comment">
@if(isset($building) && !isset($invoiceComment))
{{trim($building->invoice_comment)}}
@elseif(isset($invoiceComment))
{{trim($invoiceComment->comments)}}
@endif
</textarea>
                            @else
                                <p>@if(isset($building) && !isset($invoiceComment))
                                        {{trim($building->invoice_comment)}}
                                    @elseif(isset($invoiceComment))
                                        {{trim($invoiceComment->comments)}}
                                    @endif
                                </p>
                            @endif

                    </div>

                </div>
                <div class="col-xs-4" >
                    <b><u>Signature</u></b>
                </div>
            </div>
            </form>
            @if(isset($isPDF))
            <div class="hidden-print m-t-30 m-b-30" style="position: fixed; bottom: 10px; width: 350px; right: 18px;">
                <div class="text-right">

                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                    @if(Auth::user()->hasRole('admin') || Auth::user()->can('download_invoice'))
                        @if(isset($usageType))
                            <button  class="btn default " id="btn-invoice-download" onclick="downloadInvoice()" data-url="/invoice/downloadinvoicebyusagetype/{{$usage->id}}/{{$usageType}}"><i class="fa fa-download m-r-5" aria-hidden="true"></i>Download</button>
                        @else
                            <button  class="btn default " id="btn-invoice-download" onclick="downloadInvoice()" data-url="/invoice/download/{{$usage->id}}/{{$invoiceType}}"><i class="fa fa-download m-r-5" aria-hidden="true"></i>Download</button>
                        @endif
                    @endif
                    </div>
            </div>
                @else
                <div class="hidden-print m-t-30 m-b-30" style="position: fixed; bottom: 40px;">
                    <div class="text-center">
                        @if(isset($building) && isset($building->building_name))
                        {{$building->building_name}}<br>
                        @endif
                        @if(isset($building) && isset($building->location))
                        {{$building->location}}<br>
                        @endif
                        @if(isset($building) && isset($building->office_number))
                        Head Office Tel: {{$building->office_number}}
                        @endif
                    </div>
                </div>

                @endif
        </div>

    </div>

</div>
{{--@endif--}}
<script type="text/javascript">

    function sendInvoice() {
        window.location.href = document.getElementById("btn-invoice-send").getAttribute("data-url");
    }

    function downloadInvoice() {
        window.location.href = document.getElementById("btn-invoice-download").getAttribute("data-url");
    }

</script>