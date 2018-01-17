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
                Role
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
                <span class="panel-title add-new-role" data-toggle="modal" data-target="#add">Add Role</span>
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
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$role['name']}}</td>
                            <td>{{$role['display_name']}}</td>
                            @if (Auth::user()->hasRole('admin'))
                            <td class="text-center">
                                <a href="{{action('RoleController@edit', $role['id'])}}" data-toggle="modal" data-target="#edit" class="edit-row"><i class="mdi mdi-pencil"></i></a>
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
