<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <i class="fa fa-list panel-ico"></i>
        <span class="panel-title">PAYMENT</span>
    </div>
    <div class="panel-body">
        <div class="modal-body">
            <div class="row">
                <form class="form-horizontal customer-form" method="POST" action="{{url('payment')}}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-sm-12  m-t-10">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>What is kind of invoice you want to review?</label><br>
                                    <input type="checkbox"  name="paid" value="paid">Paid<br>
                                    <input type="checkbox"  name="unpaid" value="unpaid">Unpaid<br>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12  m-t-10">
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-danger waves-effect waves-light btn-submit-customer" type="submit">
                                    Submit
                                </button>
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
