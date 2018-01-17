@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Role</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li class="active">
                Room
            </li>
        </ol>
        </p>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading font-14">
                    <i class="fa fa-plus-circle"></i>
                    <span class="panel-title add-new-room" data-toggle="modal" data-target="#add">Add Room</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                @if (Auth::user()->hasRole('admin'))
                                    <th class="text-center" style="width:5%">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td>{{$room['room_number']}}</td>
                                    <td>{{$room['size']}}</td>
                                    @if (Auth::user()->hasRole('admin'))
                                        <?php
                                        $usingRoom = \App\Libs\Helpers::getUsingRoomById($room->id);
                                        $isRoomUsing = isset($usingRoom) && $usingRoom != null && count($usingRoom) > 0;
                                        ?>
                                        <td class="text-center">
{{--                                        <a href="{{action('RoomController@edit', $room['id'])}}" class="edit-row" data-toggle="modal" data-target="#edit"><i class="mdi mdi-pencil"></i></a>--}}
                                            <a href="{{action('RoomController@edit', $room['id'])}}" data-toggle="modal" data-target="#edit" class="edit-row"><i class="mdi mdi-pencil"></i></a>
                                            <a href="{{action('RoomController@delete', $room['id'])}}" class="table-action-btn text-danger delete-row" data-toggle="modal" data-target="#delete"><i class="mdi mdi-close"></i></a>
                                            @if($isRoomUsing)
                                                <a href="/contract/view/{{$room['id']}}" class="table-action-btn  m-r-10 "><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- end row -->
