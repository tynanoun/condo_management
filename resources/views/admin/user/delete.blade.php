<div class="panel-heading">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <i class="fa fa-list panel-ico"></i>
    <span class="panel-title">Delete CUSTOMER</span>
</div>
<div class="panel-body">
    <div class="modal-body">
        <div class="row">
            <form class="customer-form" action="{{action('UserController@deleteConfirm', $customer->id)}}" novalidate="">
                <h5>Are you sure to delete the {{$customer->first_name}} {{$customer->last_name}}?</h5>

                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">

                <div class="form-group text-right m-b-0">
                    <button class="btn btn-danger waves-effect waves-light btn-submit-customer" type="submit">
                        Delete
                    </button>
                    <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                        Cancel
                    </button>
                </div>
            </form>
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