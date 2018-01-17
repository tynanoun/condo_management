@extends('customermaster')
@section('breadcrumbs')
    <div class="col-lg-6">
        <h4 class="m-t-0 header-title">Price Setting</h4>
        <p class="text-muted font-14 m-b-20">
        <ol class="breadcrumb p-0 m-0 pull-left">
            <li>
                <a href="/usage">Home</a>
            </li>
            <li class="active">
                Price Setting
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
                <i class="fa fa-list panel-ico"></i>
                <span class="panel-title">Price Setting</span>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="datatable-keytable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Water M3</th>
                            <th>Electric (KWH)</th>
                            <th>Unit M2</th>
                            <th class="text-center" style="width:5%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$priceSetting['water_supply']}}</td>
                            <td>{{$priceSetting['electric_supply']}}</td>
                            <td>{{$priceSetting['unit_supply']}}</td>
                            <td class="text-center">
                                @if (Route::has('login') && Auth::user()->hasRole('admin'))
                                    @if(isset($priceSetting) && $priceSetting['id'] != null)
                                        <a href="{{action('PriceSettingController@edit', $priceSetting['id'])}}" class="table-action-btn edit-row"><i class="mdi mdi-pencil"></i></a>
                                    {{--@else--}}
                                        {{--<a href="{{action('PriceSettingController@create')}}" class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>--}}
                                    @endif
                                @endif
                                {{--<a href="#" class="table-action-btn" data-toggle="modal" data-target="#edit"><i class="mdi mdi-pencil"></i></a>--}}

                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--<div class="flex-center position-ref full-height">--}}
            {{--@if (Route::has('login'))--}}
                {{--<div class="top-right links">--}}
                    {{--@if (Auth::user()->hasRole('admin'))--}}
                        {{--@if(isset($priceSetting) && $priceSetting['id'] != null)--}}
                        {{--<a href="{{action('PriceSettingController@edit', $priceSetting['id'])}}" class="btn btn-warning">Update</a>--}}
                        {{--@else--}}
                        {{--<a href="{{action('PriceSettingController@create')}}" class="btn btn-warning">Update</a>--}}
                        {{--@endif--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--@endif--}}
        {{--</div>--}}

        {{--<div>--}}
            {{--Water(M3) : {{$priceSetting['water_supply']}}<br>--}}
            {{--Electric(KWH) : {{$priceSetting['electric_supply']}}<br>--}}
            {{--Unit(M2) : {{$priceSetting['unit_supply']}}<br>--}}
        {{--</div>--}}

    {{--</div>--}}
{{--@endsection--}}


