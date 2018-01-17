<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-color panel-inverse">
            <div class="panel-heading font-14">
                @if(Auth::user()->hasRole('admin') || Auth::user()->can('tenantInsert') || Auth::user()->can('staffInsert')) 
                    <i class="fa fa-plus-circle"></i>
                    @if($isStaff === true)
                    <span class="panel-title add-new-customer" data-url="/user/create/true" data-toggle="modal" data-target="#add">
                        Add Employee
                    </span>
                    @else
                    <span class="panel-title add-new-customer" data-url="/user/create/false" data-toggle="modal" data-target="#add">
                        Add Tenant
                    </span>
                    @endif
                    </span>
                 @endif
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="datatable-keytable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            @if(!$isStaff)
                            <th>Room#</th>
                            @endif
                            <th>Name</th>
                            <th>Contact Number</th>
                            @if(!$isStaff)
                            <th>Outstanding Invoice</th>
                            @endif
                            <th>Start date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <?php
                            if (!$isStaff) {
                                $strSql = "select users.* from users ";
                                $strSql .= "inner join rooms on users.room_id = rooms.id ";
                                $strSql .= "inner join usages on usages.room_id = rooms.id ";
                                $strSql .= "inner join role_user on users.id = role_user.user_id ";
                                $strSql .= "inner join roles on roles.id = role_user.role_id ";
                                $strSql .= "where rooms.is_active = ? and users.is_active = ? and roles.is_staff = ? ";
                                $strSql .= "and usages.is_paid = ? and rooms.id = ? ";

                                $usersTemp = DB::select($strSql, [1, 1, false, false, $user['room_id']]);
                                $room = DB::table('rooms')->where('id', $user['room_id'])->first();
                            }
                            ?>

                            <tr>
                                @if(!$isStaff)
                                <td>{{$room->room_number}}</td>
                                @endif

                                <td><a href="/user/customerprofile/{{$user['id']}}/{{\App\Libs\Helpers::convertNumToBoolean($isStaff)}}">{{$user['first_name']}} {{$user->last_name}}</a></td>
                                <td>{{$user['contact_number']}}
                                @if(!$isStaff)
                                <td>{{count($usersTemp)}}</td>
                                @endif
                                <td>{{\App\Libs\DateHelpers::formatDefaultDate($user['start_date'])}}</td>
                                <td>
                                    @if(Auth::user()->hasRole('admin') || Auth::user()->can('tenantView') || Auth::user()->can('staffView')) 
                                        @if(Auth::user()->hasRole('admin') || Auth::user()->can('tenantUpdate') || Auth::user()->can('staffUpdate'))
                                            <a href="/user/edit/{{$user['id']}}/{{\App\Libs\Helpers::convertNumToBoolean($isStaff)}}"  class="table-action-btn11 edit-row" data-toggle="modal" data-target="#edit"><i class="mdi mdi-pencil"></i></a>
                                        @else
                                            <a href="/user/edit/{{$user['id']}}/{{\App\Libs\Helpers::convertNumToBoolean($isStaff)}}"  class="table-action-btn11 edit-row" data-toggle="modal" data-target="#edit"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                        @endif
                                    @endif
                                    @if(Auth::user()->hasRole('admin') || Auth::user()->can('tenantDelete') || Auth::user()->can('staffDelete')) 
                                        <a href="{{action('UserController@delete', $user['id'])}}" class="table-action-btn11 text-danger delete-row" data-toggle="modal" data-target="#delete"><i class="mdi mdi-close"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
