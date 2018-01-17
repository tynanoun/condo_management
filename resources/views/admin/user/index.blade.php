<!-- index.blade.php -->
@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">{{$isStaff ? 'Staffs' : 'Tenants'}}</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li class="active">
                {{$isStaff ? 'Staffs' : 'Tenants'}}
            </li>
        </ol>
        </p>
    </div>
@endsection
@section('content')
    <div class="customer-list">
    @include('admin.user.userlist')
    </div>
@endsection
