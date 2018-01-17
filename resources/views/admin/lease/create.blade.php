@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Create Lease</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li>
                <a href="/lease">Lease</a>
            </li>
            <li class="active">
                Create Lease
            </li>
        </ol>
        </p>
    </div>
@endsection
@section('content')
    <form method="post" action="{{url('lease')}}" class="lease-form">
        {{csrf_field()}}
        <div class="col-lg-12">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading font-14">
                    <i class="fa fa-plus-circle"></i>
                    <span class="panel-title">Add New Lease</span>
                </div>
                <div class="row m-t-20 m-b-20">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="userName">Room Number<span class="text-danger">*</span></label>
                                        <select class="form-control parsley-error select2" required="" id="room_id" name="room_id">
                                            <option value="">Select</option>
                                            @foreach($rooms as $room)
                                                <option value="{{$room->id}}">{{$room->room_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="checkbox checkbox-inline m-t-30">
                                            <input type="checkbox" name="is_active" id="is_active" value="1">
                                            <label for="inlineCheckbox1"> Is active </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 m-t-10">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="">Start Current Reading Electric<span class="text-danger">*</span></label>
                                        <input type="text" name="start_current_reading_electric"  required="" class="form-control" id="start_current_reading_electric">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="userName">Start Current Reading Water<span class="text-danger">*</span></label>
                                        <input type="text" name="start_current_reading_water" parsley-trigger="change" required="" class="form-control" id="start_current_reading_water">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <div class="panel-body">
                        <h4 class="m-b-20">Lease Setting</h4>
                        <a class="btn btn-danger waves-effect waves-light m-b-20" data-toggle="modal" data-target="#add">Add New</a>
                        <div class="table-responsive">
                            <table id="datatable-keytable" class="table table-striped table-bordered add-lease">
                                <thead>
                                <tr>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Room</th>
                                    <th>Electric</th>
                                    <th>Water</th>
                                    <th class="text-center" style="width:5%">Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <button id="save" class="btn btn-danger waves-effect waves-light" type="submit">Submit</button>
                        <button type="reset" class="btn btn-inverse waves-effect m-l-5">Cancel</button>
                    </div>
            </div>
        </div>
    </form>

    <form id="form">
        <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content p-0 b-0">
                    <div class="panel panel-color panel-inverse">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <i class="fa fa-list panel-ico"></i>
                            <span class="panel-title">ADD NEW LEASE</span>
                        </div>
                        <div class="panel-body">
                            <div class="modal-body">                                           
                                
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label>Start Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" data-parsley-le="#end_date" id="start_date" class="form-control datepicker" placeholder="mm/dd/yyyy" required="">
                                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                    </div>
                                                    <span id="error_start_date" style="color: #f96a74; margin-left: 10px; font-size: 12px;">Must be smaller then end date!</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>End Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input type="text" data-parsley-gt="#start_date" id="end_date" class="form-control datepicker" placeholder="mm/dd/yyyy" required="">
                                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                    </div>
                                                    <span id="error_end_date" style="color: #f96a74; margin-left: 10px; font-size: 12px;">Must be greater then start date!</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 m-t-20">
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label for="room_discount">Room Discount</label>
                                                    <input type="text" id="room_discount" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="room_whole">Room Whole</label>
                                                    <input type="text" id="room_whole" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 m-t-20">
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label for="electric_discount">Electric Discount</label>
                                                    <input type="text" id="electric_discount" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="electric_whole">Electric Whole</label>
                                                    <input type="text" id="electric_whole" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 m-t-20">
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <label for="water_discount">Water Discount</label>
                                                    <input type="text" id="water_discount" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="water_whole">Water Whole</label>
                                                    <input type="text" id="water_whole" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 m-t-20">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-danger waves-effect waves-light" type="submit" id="add_lease_click">Add</button>
                                                    <button type="reset" class="btn btn-inverse waves-effect m-l-5">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
@endsection

@section('js')
<script type="text/javascript">

    $(document).ready(function() {

        var room_id = 0;
        var room_number = "";
        var index = 0;

        //Price
        var room_price;
        var electric_price;
        var water_price;

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

        var frm = $('.lease-form');

        $('#room_id').on('change', function() {

            room_id = this.value
            room_number = $(this).find(":selected").text();

            $.ajax({
                type: 'GET',
                url: '/lease/' + room_id,
                async: true,
                dataType: "json",
                success: function(data){
                    $.each(data, function(i, item) { 
                       room_price  = item.unit_supply;
                       water_price = item.water_supply;
                       electric_price = item.electric_supply;
                    });
                },
                error: function(data){}
            });
        });

        var discount_as_price = function(price, dicount_in_percentage){
            var discount = (price * dicount_in_percentage)/100;   
            return price - discount; 
        }

        var discount_as_percentage = function(price, dicount_in_price){
            var discount = (dicount_in_price * 100)/price;    
            return (100 - discount); 
        }

        $("#room_whole").keyup(function(){
            $('#room_discount').val(discount_as_price(room_price, $(this).val()));
        });

        $("#room_discount").keyup(function(){
            $('#room_whole').val(discount_as_percentage(room_price, $(this).val()));
        });

        $("#electric_whole").keyup(function(){
            $('#electric_discount').val(discount_as_price(electric_price, $(this).val()));
        });

        $("#electric_discount").keyup(function(){
            $('#electric_whole').val(discount_as_percentage(electric_price, $(this).val()));
        });

        $("#water_whole").keyup(function(){
            $('#water_discount').val(discount_as_price(water_price, $(this).val()));
        });

        $("#water_discount").keyup(function(){
            $('#water_whole').val(discount_as_percentage(water_price, $(this).val()));
        });

        $(document).on("click", '#save', function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '/check',
                data: {
                    "_token": "{{ csrf_token()}}",
                    'room_id': $('#room_id').val()
                },
                async: true,
                dataType: "json",
                success: function(data){
                    if(data['message'] == '1'){
                       alert('The romm are already exists!');
                    }else{
                        $(".lease-form").unbind().submit();
                    }
                    
                }
            });
        });

        $("#add_lease_click").click(function(event) {
            event.preventDefault();
            if(!$('#form').parsley().validate()){
                return 0;
            }
            
            $('.dataTables_empty').parents("tr").remove();

            var end = new Date($("#end_date").val());
            var start;

            $('table.add-lease tbody tr').each(function() {
                start = new Date($(this).children().eq(1).text());
            });

            if(start > end){
                alert('Date are already exist 111');
                return 0;
            }

            if($('#add_lease_click').text() === "Add"){
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();
                var room_discount = $("#room_discount").val();
                var room_whole = $('#room_whole').val();
                var electric_discount = $("#electric_discount").val();
                var electric_whole = $('#electric_whole').val();
                var water_discount = $('#water_discount').val();
                
                add_row(start_date, end_date, room_discount, room_whole, electric_discount, electric_whole, water_discount);
                $('#add').modal('hide');
                $("#start_date").val('');
                $("#end_date").val('');
                $('#room_whole').val('');
                $('#room_discount').val('');
                $('#electric_discount').val('');
                $('#electric_whole').val('');
                $('#water_discount').val('');  
            }else{
                $('#add').modal('hide');
                $('#add_lease_click').html("Add");

                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();
                var room = $("#room_discount").val();
                var room_whole = $('#room_whole').val();
                var electrict = $("#electric_discount").val();
                var electric_whole = $('#electric_whole').val();
                var water = $('#water_discount').val();

                
                //edit row on table
                $('.add-lease tr').eq(index).find('td').eq(0).html('<input type="hidden" name="start_date[]" id="start_date_'+index+'" value="'+start_date+'">'+start_date+'');
                $('.add-lease tr').eq(index).find('td').eq(1).html('<input type="hidden" name="end_date[]" id="end_date_'+index+'" value="'+end_date+'">'+end_date+'');
                $('.add-lease tr').eq(index).find('td').eq(2).html('<input type="hidden" name="room[]" id="room_'+index+'" value="'+room+'"><input type="hidden" name="room_whole[]" id="room_whole_'+index+'" value="'+room_whole+'">'+room+'');
                $('.add-lease tr').eq(index).find('td').eq(3).html('<input type="hidden" name="electrict[]" id="electrict_'+index+'" value="'+electrict+'"><input type="hidden" name="electric_whole[]" id="electric_whole_'+index+'" value="'+electric_whole+'">'+electrict+'');
                $('.add-lease tr').eq(index).find('td').eq(4).html('<input type="hidden" name="water[]" id="water_'+index+'" value="'+water+'">'+water+'');

            }
        });

        var i = $('table.add-lease tr').length;

        var add_row = function(start_date, end_date, room, room_whole, electrict, electric_whole, water){
            html = '<tr>';
            html += '<td><input type="hidden" name="start_date[]" id="start_date_'+i+'" value="'+start_date+'">'+start_date+'</td>';
            html += '<td><input type="hidden" name="end_date[]" id="end_date_'+i+'" value="'+end_date+'">'+end_date+'</td>';
            html += '<td><input type="hidden" name="room[]" id="room_'+i+'" value="'+room+'"><input type="hidden" name="room_whole[]" id="room_whole_'+i+'" value="'+room_whole+'">'+room+'</td>';
            html += '<td><input type="hidden" name="electrict[]" id="electrict_'+i+'" value="'+electrict+'"><input type="hidden" name="electric_whole[]" id="electric_whole_'+i+'" value="'+electric_whole+'">'+electrict+'</td>';
            html += '<td><input type="hidden" name="water[]" id="water_'+i+'" value="'+water+'">'+water+'</td>';
            html += '<td class="text-center"><a href="'+i+'" class="table-action-btn edit"><i class="mdi mdi-pencil"></i><a href="#" class="table-action-btn text-danger delete"><i class="mdi mdi-close"></i></a></td>';
            html += '</tr>';
            $('table.add-lease').append(html);
            i++;
        };

        $(document).on("click", '.delete', function(e){
            e.preventDefault();
            $(this).parents("tr").remove();
            
        });

        $(document).on("click", '.edit', function(e){
            e.preventDefault();
            $('#add_lease_click').html("Edit");
            index = $(this).attr('href');

            var start_date = $('#start_date_' + index).val();
            var end_date = $('#end_date_' + index).val();
            var room = $('#room_' + index).val();
            var room_whole = $('#room_whole_' + index).val();
            var electrict = $('#electrict_' + index).val();
            var electric_whole = $('#electric_whole_' + index).val();
            var water = $('#water_' + index).val();

            $("#start_date").val(start_date);
            $("#end_date").val(end_date);
            $('#room_discount').val(room);
            $('#room_whole').val(room_whole);
            $('#water_discount').val(water);
            $('#electric_discount').val(electrict);
            $('#electric_whole').val(electric_whole);
            $('#water_discount').val(water);
            $('#add').modal('show');
        });

        $('#add').on('hidden.bs.modal', function () {
            $('#add_lease_click').html("Add");
            $("#start_date").val('');
            $("#end_date").val('');
            $('#room_whole').val('');
            $('#room_discount').val('');
            $('#electric_discount').val('');
            $('#electric_whole').val('');
            $('#water_discount').val('');
        });

    });

</script>
@endsection

