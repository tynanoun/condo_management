<!-- index.blade.php -->
@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Maintenance</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li class="active">
                Maintenance
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
                    <span class="panel-title" data-toggle="modal" data-target="#add" id="add_new">Add New Task</span>
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="company-card card-box">
                                @foreach($maintenances as $maintenance)
                                <b>
                                    {{ $maintenance->status === 1 ? "In progress" : "Done" }} assigned to {{$maintenance->first_name}}
                                </b>
                                <div class="m-t-20">
                                    <h5 class="font-normal text-muted">Update by {{$maintenance->first_name}} at {{$maintenance->updated_at}} 
                                        <span class="pull-right m-r-15">
                                            @if(Auth::user()->hasRole('admin') || Auth::user()->can('maintenanceView'))
                                                @if(Auth::user()->can('maintenanceEdit'))
                                                    <a href="{{route('maintenances.edit',$maintenance->id)}}" class="table-action-btn edit-click"><i class="mdi mdi-pencil"></i></a>
                                                @else 
                                                    <a href="{{route('maintenances.edit',$maintenance->id)}}" class="table-action-btn edit-click"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                @endif
                                            @endif
                                            
                                            <a href="{{route('maintenances.show',$maintenance->id)}}" class="table-action-btn text-danger work-order"><i class="fa fa-tasks"></i></a>
                                        </span>
                                    </h5>
                                </div>
                                <hr/>
                                @endforeach
                            </div>
                        </div><!-- end col -->

                        <div class="col-lg-4">
                            <div class="company-card card-box bg-right">
                                <p>Opened by</p>
                                <i class="fa fa-user-circle-o user-profile-img" aria-hidden="true"></i>
                                <!--<img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="logo" class="company-logo">-->
                                <div class="company-detail">
                                    <h4 class=" m-b-5">{{$user->display_name}}</h4>
                                    <p>{{$user->name}}</p>
                                </div>
                                <div class="text-center m-t-30 ">
                                    <!--
                                    <h5 class="font-normal text-muted text-left">096 444 1024</h5>
                                    <h5 class="font-normal text-muted text-left">user@gmail.com</h5>
                                    -->
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="maintenances" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;"></div>
@endsection

@section('js')
    <script type="text/javascript">

        $( document ).ready(function() {

            $( "#add_new" ).click(function(event) {

                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'get',
                    url: 'maintenances/create',
                    async: true,
                    success: function(response){
                        $('#maintenances').html(response);
                        $('#maintenances').modal('show');
                    },
                    error: function(data){}
                });
            });


            $( ".edit-click" ).click(function(event) {

                event.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'GET',
                    url: $(this).attr('href'),
                    async: true,
                    success: function(response){
                        $('#maintenances').html(response);
                        $('#maintenances').modal('show');
                    },
                    error: function(data){}
                });

            });

            $( ".work-order" ).click(function(event) {

                event.preventDefault();
                
                $.ajax({
                    type: 'GET',
                    url: $(this).attr('href'),
                    async: true,
                    success: function(response){
                        $('#maintenances').html(response);
                        $('#maintenances').modal('show');
                    },
                    error: function(data){}
                });
            });
            
        });

    </script>
@endsection




