
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <i class="fa fa-list panel-ico"></i>
        <span class="panel-title">ADD NEW CUSTOMER</span>
    </div>
    <div class="panel-body">
        <div class="modal-body">
            <form class="form-horizontal customer-form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                {{--<input name="_method" type="hidden" value="PATCH">--}}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{--<label for="userName">First Name<span class="text-danger">*</span></label>--}}
                            {{--<input id="first_name" type="text" parsley-trigger="change" class="form-control" name="first_name" required="">--}}

                            <label for="first_name">First Name<span class="text-danger">*</span></label>
                            <input type="text" name="first_name" parsley-trigger="change" required="" class="form-control" id="first_name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="userName">Last Name<span class="text-danger">*</span></label>
                            <input id="last_name" type="text" parsley-trigger="change" class="form-control" name="last_name" required="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="heard">Room Number<span class="text-danger">*</span></label>
                            <?php $value = 0; ?>
                            {{--<select name="room_id" class="form-control parsley-error select2 form-control select2-multiple select2-hidden-accessible" required="" data-parsley-id="9" multiple="" data-placeholder="Choose assets." tabindex="-1" aria-hidden="true">--}}
                            <select name="room_id" class="form-control select2" required="" data-parsley-id="9" data-placeholder="Choose assets." tabindex="-1" aria-hidden="true">
                                <?php foreach($rooms as $room) { ?>
                                <option value="<?php echo $room->id ?>">
                                    <?php echo $room->room_number ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="heard">User Role<span class="text-danger">*</span></label>
                            <?php $value = 0; ?>
                            <select name="role_id" class="form-control parsley-error" required="">
                                <?php foreach($roles as $role) { ?>
                                <option value="<?php echo $role->id ?>"
                                ><?php echo $role->display_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="userName">Phone Number<span class="text-danger">*</span></label>
                            <input id="contact_number" type="text" parsley-trigger="change" class="form-control" name="contact_number" required="">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="userName">Other contact (Optional)</label>
                            <input id="main_contact" type="text" parsley-trigger="change" class="form-control" name="main_contact">

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                            <input id="email" type="email" parsley-trigger="change" class="form-control" name="email" required="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="passWord2">Confirm Password</label>
                            <input id="password-confirm" data-parsley-equalto="#password" type="password" class="form-control" name="password_confirmation" required="">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="" alt="image">
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <button type="button" class="btn btn-default btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="btn-default">
                                        </button>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0 pull-left m-l-10">
                        <button class="btn btn-danger waves-effect waves-light btn-submit-customer" type="submit">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript">

        var frm = $('#customer-form');

        frm.submit(function (e) {

            e.preventDefault();

            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                data: frm.serialize(),
                success: function (data) {
                    console.log('Submission was successful.');
                    console.log(data);
                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
        });

//        $('.btn-submit-customer').click(function () {
//            event.preventDefault();
//            var frm = $('.customer-form');
//
//            $.ajaxSetup({
//                headers: {
//                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                }
//            });
//            $.ajax({
//                type: frm.attr('method'),
//                url: frm.attr('action'),
//                dataType : 'json',
//                data: frm.serialize(),
//                success: function (data) {
//                    $('#yorkroup-modal').modal('hide');
//                    location.reload();
//                },
//                error: function (xhr, status, error) {
//                    var object = JSON.stringify(eval("(" + xhr.responseText + ")"));
//                    var json = JSON.parse(object);
//                    document.getElementById("first_name222").innerHTML = json["first_name"];
//                }
//            });
//            return false;
//        });

    </script>