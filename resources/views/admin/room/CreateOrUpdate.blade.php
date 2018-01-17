<?php
    $roomNumber = '';
    $roomSize = '';
    $roomDescription = '';
    $action = action('RoomController@store');
    if (isset($isEdit) && $isEdit && isset($room) && $room != null) {
        $roomNumber = $room->room_number;
        $roomSize = $room->size;
        $roomDescription = $room->description;
        $action = action('RoomController@update', $room->id);
    }
?>
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <i class="fa fa-list panel-ico"></i>
            <span class="panel-title">{{isset($isEdit) && $isEdit ? 'Edit' : 'Create'}} User</span>
        </div>
        <div class="panel-body">
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal room-form" method="POST" action="{{$action}}" data-validate="parsley">
                    @if(isset($isEdit) && $isEdit && isset($room) && $room != null)
                        <input name="_method" type="hidden" value="PATCH">
                    @endif
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12  m-t-10">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <div class="col-md-6">
                                            <label for="room_number">Room Number</label>
                                            <input id="room_number" parsley-trigger="change" type="text" class="form-control" name="room_number" value="{{$roomNumber}}" required data-required="true">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="userName">Size(m<sup>2</sup></label>
                                        <input id="size" type="text" parsley-trigger="change" class="form-control" name="size" value="{{$roomSize}}" required data-required="true">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12  m-t-10">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label for="textarea">Description</label>
                                        <div>
                                            <textarea id="description" parsley-trigger="change" required type="text" class="form-control" name="description" value="{{$roomDescription}}">{{$roomDescription}}</textarea>
                                            </div>
                                    </div>
                                    <div class="col-sm-12 m-t-10 text-right">
                                        <button class="btn btn-danger waves-effect waves-light btn-submit-room" type="submit">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

    $('.btn-submit-room').click(function (event) {
        event.preventDefault();
        var frm = $('.room-form');
        if(!frm.parsley().validate()){
            return 0;
        }

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
                if(!data['error']){
                    $('#yorkroup-modal').modal('hide');
                    location.reload();
                }else{
                    alert(data['message']);
                }
            },
            error: function (xhr, status, error) {
                $('.modal-content').html(xhr.responseText);
            }
        });

        return false;
    });

</script>
