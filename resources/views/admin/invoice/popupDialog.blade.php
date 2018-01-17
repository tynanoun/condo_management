<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <i class="fa fa-list panel-ico"></i>
        <span class="panel-title">PAYMENT</span>
    </div>
    <div class="panel-body">
        <div class="modal-body">
            <div class="row">
             @if($isPaymentDialog)
                <form class="form-horizontal customer-form" method="POST" action="{{action('InvoiceController@paid')}}">
             @else
                <form class="form-horizontal customer-form" method="POST" action="{{action('InvoiceController@view')}}">
             @endif
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-12  m-t-10">
                            <div class="form-group">
                                <div class="col-sm-6">
                            @if($isPaymentDialog)
                                <label>What do you want to pay?</label><br>
                                <input name="usage_id" type="hidden" value="{{$usage->id}}">
                                @if($totalElectricCost > 0)
                                    <input type="checkbox"  name="is_electric_paid" {{isset($payment) && $payment->is_electric_paid == true ? 'checked' : ''}} value="1"> Electric ({{\App\Libs\Helpers::formatAmountToUS($totalElectricCost)}})<br>
                                @endif
                                @if($totalWaterCost > 0)
                                    <input type="checkbox"  name="is_water_paid" {{isset($payment) && $payment->is_water_paid == true ? 'checked' : ''}} value="1"> Water ({{\App\Libs\Helpers::formatAmountToUS($totalWaterCost)}})<br>
                                @endif
                                @if($totalRoomCost > 0)
                                    <input type="checkbox"  name="is_room_paid" {{isset($payment) && $payment->is_room_paid == true ? 'checked' : ''}} value="1"> Room ({{\App\Libs\Helpers::formatAmountToUS($totalRoomCost)}})<br>
                                @endif
                            @else
                                <input name="usage_id" type="hidden" value="{{$usage->id}}">
                                <label>What is kind of invoice you want to review?</label><br>
                                <input type="radio" name="invoiceType" value="1"> Paid<br>
                                <input type="radio" name="invoiceType" value="2"> Unpaid<br>
                            @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12  m-t-10">
                            <div class="form-group text-right m-b-0">
                                @if ($isPaymentDialog)
                                <button class="btn btn-danger waves-effect waves-light btn-submit-customer" type="submit">
                                    Submit
                                </button>
                                    @else
                                    <button class="btn btn-danger waves-effect waves-light" type="submit">
                                        Submit
                                    </button>
                                @endif
                                <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('.btn-submit-customer').click(function () {
        event.preventDefault();
        var frm = $('.customer-form');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            dataType : 'json',
            data: frm.serialize(),
            success: function (data) {
                $('#yorkroup-modal').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                $('.modal-content').html(xhr.responseText);
            }
        });

        return false;
    });

</script>
