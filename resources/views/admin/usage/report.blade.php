@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Report</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li class="active">
                Report
            </li>
        </ol>
        </p>
    </div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="bg">
                    <ul class="nav nav-tabs tabs-bordered">
                        <li class="active">
                            <a href="#monthly" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-calendar"></i></span>
                                <span class="hidden-xs">Monthly Usage</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#lease" data-toggle="tab" aria-expanded="true" class="lease-tab">
                                <span class="visible-xs"><i class="fa fa-calendar"></i></span>
                                <span class="hidden-xs">Lease</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="#home-b1" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">Highest Consumption</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#profile-b1" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">Outstanding Invoice</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-box">
                    <div class="tab-content">
                        <div class="tab-pane active" id="monthly">
                            <div class="row m-b-30">
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title m-t-0">Monthly Usage</h4>
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="m-t-20 m-b-20">
                                                        <h4 class="m-b-10">5623</h4>
                                                        <p class="text-uppercase m-b-5 font-13 font-600">Total Electronic</p>
                                                        <p class="text-danger">18 / KWH</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-t-10">
                                            <div id="overlapping-bars" class="ct-slice-donut ct-golden-section"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-box">
                                        <h4 class="header-title m-t-0">Monthly Usage</h4>

                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="m-t-20 m-b-20">
                                                        <h4 class="m-b-10">10005</h4>
                                                        <p class="text-uppercase m-b-5 font-13 font-600">Total Water</p>
                                                        <p class="text-info">18 / KWH</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="m-t-10">
                                            <div id="overlapping-barss" class="ct-chart ct-golden-section "></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="lease">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel-color panel-inverse">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Lease</th>
                                                        <th>Paid</th>
                                                        <th>Day Remaining</th>
                                                        <th>Rent</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="room-lease">
                                                    <!--
                                                    <tr>
                                                        <td>45 elm st.200 | Cheasarat <p>096 444 1024</p></td>
                                                        <td>Active</td>
                                                        <td>738383</td>
                                                        <td>$800</td>
                                                    </tr>
                                                    -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="home-b1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel-color panel-inverse">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table id="datatable-keytable" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Room#</th>
                                                        <th>Customer</th>
                                                        <th>Avg.Water</th>
                                                        <th>Avg.Electric</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @for($i=0; $i< count($consumptions); $i++)

                                                    {{--//@foreach($consumptions as $consumption)--}}
                                                    <tr>
                                                        <td>{{$consumptions[$i]->room_number}}</td>
                                                        <td>{{$consumptions[$i]->first_name}} {{$consumptions[$i]->last_name}}</td>
                                                        <td>{{$consumptions[$i]->avg_water}}/M3</td>
                                                        <td>{{$consumptions[$i]->avg_kwh}}/KW</td>
                                                    </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile-b1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel-color panel-inverse">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Room#</th>
                                                        <th>Name</th>
                                                        <th>Contact Number</th>
                                                        <th>Outstanding Invoice</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @for($j = 0; $j < count($outstandings); $j++)
                                                        <?php
                                                        $strSql = "select users.* from users ";
                                                        $strSql .= "inner join rooms on users.room_id = rooms.id ";
                                                        $strSql .= "inner join usages on usages.room_id = rooms.id ";
                                                        $strSql .= "inner join role_user on users.id = role_user.user_id ";
                                                        $strSql .= "inner join roles on roles.id = role_user.role_id ";
                                                        $strSql .= "where rooms.is_active = ? and users.is_active = ? and roles.is_staff = ? ";
                                                        $strSql .= "and usages.is_paid = ? and rooms.id = ? ";

                                                        $users = DB::select($strSql, [1, 1, false, false, $outstandings[$j]->room_id]);
                                                        ?>

                                                    {{--@foreach($outstandings as $outstanding)--}}
                                                    <tr>
                                                        <td>{{$outstandings[$j]->room_number}}</td>
                                                        <td>{{$outstandings[$j]->first_name}} {{$outstandings[$j]->last_name}}</td>
                                                        <td>{{$outstandings[$j]->contact_number}}</td>
                                                        <td>{{count($users)}}</td>
                                                    </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">

        $(document).ready(function(){

            function daydiff(date) {
                var current_date = new Date();
                var end_date = new Date(date);
                var timeDiff = Math.abs(end_date.getTime() - current_date.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                return diffDays;
            }

            $(".lease-tab").on("click", function () {
                $('#room-lease').html('');
                $.ajax({
                    type: 'GET',
                    url: '/usage/lease',
                    async: true,
                    dataType: "json",
                    success: function(data){
                        $.each(data, function(i, item) {
                            var rent = item.room_price != 0 ? item.size * item.room_price : item.unit_supply;
                            html = '<tr>';
                            html += '<td>'+ item.room_number +'</td>'; 
                            html += '<td>'+ item.is_active +'</td>';
                            html += '<td>'+ daydiff(item.end_date) +'</td>';
                            html += '<td>'+ rent + '</td>';
                            html += '</tr>';
                            $('#room-lease').append(html);
                        });
                    },
                    error: function(data){}
                });
            });
        });

    </script>
@endsection