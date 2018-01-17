@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Electric Rate</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{url('pricesetting')}}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('water_supply') ? ' has-error' : '' }}">
                                <label for="water_supply" class="col-md-4 control-label">Water supply per m3</label>

                                <div class="col-md-6">
                                    <input id="water_supply" type="text" class="form-control" name="water_supply" value="{{ old('water_supply') }}" required autofocus>

                                    @if ($errors->has('water_supply'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('water_supply') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('electric_supply') ? ' has-error' : '' }}">
                                <label for="electric_supply" class="col-md-4 control-label">Electric Supply</label>

                                <div class="col-md-6">
                                    <input id="electric_supply" type="text" class="form-control" name="electric_supply" value="{{ old('electric_supply') }}" required autofocus>

                                    @if ($errors->has('electric_supply'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('electric_supply') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('unit_supply') ? ' has-error' : '' }}">
                                <label for="rate" class="col-md-4 control-label">Unit Supply per Square Meter</label>

                                <div class="col-md-6">
                                    <input id="unit_supply" type="text" class="form-control" name="unit_supply" value="{{ old('unit_supply') }}" required autofocus>

                                    @if ($errors->has('unit_supply'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('unit_supply') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
