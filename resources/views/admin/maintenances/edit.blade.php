@foreach($maintenance as $row)
    <form class="form-horizontal maintenance-form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <i class="fa fa-list panel-ico"></i>
                        <span class="panel-title">Add Task</span>
                    </div>
                    <div class="panel-body">
                        <div class="modal-body">                                           

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label for="userName">Task Name</label>
                                            <input type="text" value="{{$row->task_name}}" name="task_name" parsley-trigger="change" required="" class="form-control" id="task_name">
                                            <input type="hidden" name="action" id="action" value="update">
                                            <input type="hidden" name="id" id="action" value="{{$row->id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label>Start Date</label>
                                            <div class="input-group">
                                                <input type="text" value="{{date('m/d/Y', strtotime($row->start_date))}}" class="form-control" placeholder="mm/dd/yyyy" id="start_date" name="start_date" required="">
                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                            </div>
                                            <span id="error_start_date" style="color: #f96a74; margin-left: 10px; font-size: 12px;">Must be smaller then end date!</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>End Date</label>
                                            <div class="input-group">
                                                <input type="text" value="{{date('m/d/Y', strtotime($row->end_date))}}" class="form-control" placeholder="mm/dd/yyyy" id="end_date" name="end_date" required="">
                                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                            </div>
                                            <span id="error_end_date" style="color: #f96a74; margin-left: 10px; font-size: 12px;">Must be greater then start date!</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12  m-t-10">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label for="userName">Name of Room</label>
                                            <select class="form-control select2" name="room_id" required="">
                                                <option value="">Select</option>
                                                @foreach($rooms as $room)
                                                    @if ($room->id === $row->room_id)
                                                        <option value="{{$room->id}}" selected>{{$room->room_number}}</option>
                                                    @else
                                                        <option value="{{$room->id}}">{{$room->room_number}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="userName">Assigned to</label>
                                            <select class="form-control select2" name="user_id" required="">
                                                <option value="">Select</option>
                                                @foreach($users as $user)
                                                    @if ($user->id === $row->assign_user_id)
                                                        <option value="{{$user->id}}" selected>{{$user->first_name}}</option>
                                                    @else
                                                        <option value="{{$user->id}}">{{$user->first_name}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 m-t-20">
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <label for="userName">Description</label>
                                                <textarea class="form-control parsley-error" name="description">{{$row->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <label for="userName">Picture</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->can('maintenanceEdit')) 
                                    <div class="col-sm-12 m-t-20">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-danger waves-effect waves-light" type="submit" id="add">Submit</button>
                                                <button type="reset" class="btn btn-inverse waves-effect m-l-5">Cancel</button>
                                            </div>
                                        </div>
                                    </div>    
                                @endif
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
 @endforeach
<script type="text/javascript">

    $( document ).ready(function() {

        $(".datepicker").datepicker({
            maxDate: '0',
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        $(".select2").select2({
            placeholder: 'Select an option'
        });

        $('#error_end_date').hide();
        $('#error_start_date').hide();

        $(document).on('change', '#start_date', function(e) {
            var end_date = new Date($('#end_date').val());
            var start_date = new Date(e.target.value);
            if(start_date > end_date){
                $('#error_start_date').show();
            }else{
                $('#error_start_date').hide();
            }
        });

        $(document).on('change', '#end_date', function(e) {
            var start_date = new Date($('#start_date').val());
            var end_date = new Date(e.target.value);
            if(start_date > end_date){
                $('#error_end_date').show();
            }else{
                $('#error_end_date').hide();
            }
        });

        $("#add").click(function(event) {

            event.preventDefault();
            var frm = $('.maintenance-form');

            if(!frm.parsley().validate()){
                return 0;
            }
            
            frm.ajaxSubmit({
                type: 'POST',
                url: 'maintenances',
                dataType : 'json',
                data: $('.maintenance-form').serialize(),
                success: function (response) {
                    if(response['error']){
                        alert(response['message']);
                    }else{
                        $('#maintenances').modal('hide');
                        location.reload();
                    }
                },
                error: function (xhr, status, error) {
                    $('.modal-content').html(xhr.responseText);
                }
            });

        });
    });

</script>