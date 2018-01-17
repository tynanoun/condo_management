<?php
$firstName = '';
$lastName = '';
$roomId = '';
$roleId = '';
$startDate = '';
$endDate = '';
$phoneNumber = '';
$mainContact = '';
$email = '';
$password = '';
$confirmPassword = '';
$imageUrl = '';

$action = action('UserController@store');
if (isset($isEdit) && $isEdit && isset($user) && $user != null) {
    $firstName = $user->first_name;
    $lastName = $user->last_name;
    $roomId = $user->room_id;
    $roleId = $user->role_id;
    $startDate = $user->start_date;
    $endDate = $user->end_date;
    $phoneNumber = $user->contact_number;
    $mainContact = $user->main_contact;
    $email = $user->email;
    $password = $user->password;
    $confirmPassword = $user->password_confirmation;
    $imageUrl = $user->image;
    $action = action('UserController@update', $user->id);
}
?>
<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <i class="fa fa-list panel-ico"></i>
        <span class="panel-title">ADD NEW CUSTOMER</span>
    </div>
    <div class="panel-body">
        <div class="modal-body">
            <form class="form-horizontal customer-form" method="POST" action="{{$action}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if (isset($isEdit) && $isEdit && isset($user) && $user != null)
                <input name="_method" type="hidden" value="PATCH">
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="userName">First Name<span class="text-danger">*</span></label>
                                {{--<input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="firstname">--}}
                                <input id="first_name" type="text" parsley-trigger="change" class="form-control" name="first_name" value="{{$firstName}}" required="">

                            </div>
                            <div class="col-sm-6">
                                <label for="userName">Last Name<span class="text-danger">*</span></label>
                                <input id="last_name" type="text" parsley-trigger="change" class="form-control" name="last_name" value="{{$lastName}}" required="">

                                {{--<input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="lastname">--}}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12  m-t-10">
                        <div class="form-group">
                            @if($isStaff === 'false')
                                <div class="col-sm-6">
                                    <label for="userName">Room Number<span class="text-danger">*</span></label>
                                    <?php $value = 0; ?>
                                    {{--<select name="room_id" class="form-control parsley-error select2 form-control select2-multiple select2-hidden-accessible" required="" data-parsley-id="9" multiple="" data-placeholder="Choose assets." tabindex="-1" aria-hidden="true">--}}
                                    <select name="room_id" id="room_id" class="form-control select2" required="" data-parsley-id="9" data-placeholder="Choose assets." tabindex="-1" aria-hidden="true">
                                        <?php foreach($rooms as $room) { ?>
                                        <option value="<?php echo $room->id ?>"<?php
                                            if($room->id == $roomId) {
                                                echo " selected";
                                            } ?>><?php echo $room->room_number ?></option>
                                        <?php } ?>
                                    </select>
                                    <span id="error_room" style="color: red; margin-left: 10px;">Room number is already exist!</span>
                                </div>
                            @endif
                            <div class="col-sm-6">
                                <label for="userName">User Role<span class="text-danger">*</span></label>
                                <?php $value = 0; ?>
                                <select name="role_id" class="form-control parsley-error" required="">
                                    <?php foreach($roles as $role) { ?>
                                    <option value="<?php echo $role->id ?>"<?php
                                        if($role->id == $roleId) {
                                            echo " selected";
                                        } ?>><?php echo $role->display_name ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 m-t-10">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label for="start_date">Start Date<span class="text-danger">*</span></label>
                                <div>
                                    <div class="input-group">
                                        <input id="start-date" type="text" parsley-trigger="change" class="form-control datepicker" name="start_date" value="{{ $startDate}}" required="">
                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                    </div><!-- input-group -->
                                    <span id="error_start_date" style="color: red; margin-left: 10px;">Must be smaller then end date!</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="end_date">End Date<span class="text-danger">*</span></label>
                                <div>
                                    <div class="input-group">
                                        <input id="end-date" type="text" parsley-trigger="change" class="form-control datepicker" name="end_date" value="{{ $endDate}}">
                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                    </div><!-- input-group -->
                                    <span id="error_end_date" style="color: red; margin-left: 10px;">Must be greater then start date!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 m-t-10">
                        <div class="form-group">
                            <div class="col-sm-6">

                                <label for="userName">Phone Number<span class="text-danger">*</span></label>
                                <input id="contact_number" type="text" parsley-trigger="change" class="form-control" name="contact_number" value="{{ $phoneNumber}}" required="">
                                {{--<input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="phone">--}}
                            </div>
                            <div class="col-sm-6">
                                <label for="userName">Other contact (Optional)</label>
                                {{--<input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="phone">--}}
                                <input id="main_contact" type="text" parsley-trigger="change" class="form-control" name="main_contact" value="{{ $mainContact }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 m-t-10">
                        <div class="form-group">
                            <div class="col-sm-6">

                                <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                <input id="email" type="email" parsley-trigger="change" class="form-control" name="email" value="{{ $email }}" required="">
                                {{--<input type="email" name="email" parsley-trigger="change" required="" class="form-control" id="emailAddress">--}}

                                <label for="password" class="m-t-10">Password<span class="text-danger">*</span></label>
                                <input id="password" type="password" class="form-control" name="password">

                                <label for="password-confirm" class="m-t-10">Confirm Password <span class="text-danger">*</span></label>
                                <input id="password-confirm" data-parsley-equalto="#password" type="password" class="form-control" name="password_confirmation">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailAddress">Profile</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
                                        <div class="fileupload-new thumbnail" style="width: 250px; height: 150px;">
                                            <img src="\images\{{$imageUrl}}" alt="image">
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                                        <div>
                                            <button type="button" class="btn btn-default btn-file">
                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                <input type="file" class="btn-default" id="image" name="image" value="\image\{{$imageUrl}}">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->hasRole('admin') || Auth::user()->can('tenantUpdate') || Auth::user()->can('staffUpdate'))
                                <div class="col-sm-12 m-t-20">
                                    <button class="btn btn-danger waves-effect waves-light btn-submit-customer" type="submit">Submit</button>
                                    <button type="reset" class="btn btn-inverse waves-effect m-l-5">Cancel</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{--</div>--}}

<script type="text/javascript">

    $( document ).ready(function() {

        $('.datepicker').datepicker({
            maxDate: '0',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#error_room').hide();
        $('#error_end_date').hide();
        $('#error_start_date').hide();

        $('#end-date').datepicker().on("input change", function (e) {
            var start_date = new Date($('#start-date').val());
            var end_date = new Date(e.target.value);
            if(start_date > end_date){
                $('#error_end_date').show();
            }else{
                $('#error_end_date').hide();
            }
        });

        $('#start-date').datepicker().on("input change", function (e) {
            var end_date = new Date($('#end-date').val());
            var start_date = new Date(e.target.value);
            if(start_date > end_date){
                $('#error_start_date').show();
            }else{
                $('#error_start_date').hide();
            }
        });

        $('.btn-submit-customer').click(function () {

            event.preventDefault();
            var frm = $('.customer-form');

            if(frm.parsley().validate()){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                frm.ajaxSubmit({
                    type: frm.attr('method'),
                    url: frm.attr('action'),
                    dataType : 'json',
                    data: frm.serialize(),
                    success: function (data) {
                        if(data['error']){
                            $('#error_room').show();
                        }else{
                            $('#yorkroup-modal').modal('hide');
                            location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        $('.modal-content').html(xhr.responseText);
                    }
                });
            }
        });

    });
    //
    //    $("#start-date").datepicker();
    //    $("#end-date").datepicker();


</script>