{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<div class="container">--}}
<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <i class="fa fa-list panel-ico"></i>
        <span class="panel-title">Edit Price Setting</span>
    </div>
    <div class="panel-body">
        <div class="modal-body">
            <div class="row">
                <form novalidate="" method="POST" class="price-setting-form" action="{{action('PriceSettingController@update', $priceSetting->id)}}">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('water_supply') ? ' has-error' : '' }}">
                                <label>Water Supply Per M3</label>
                                <input type="text" id="water_supply" parsley-trigger="change" class="form-control" name="water_supply" value="{{ $priceSetting->water_supply }}" required autofocus>
                                @if ($errors->has('water_supply'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('water_supply') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('electric_supply') ? ' has-error' : '' }}">
                                <label>Water Supply</label>
                                <input type="text" id="electric_supply" parsley-trigger="change" class="form-control" name="electric_supply" value="{{ $priceSetting->electric_supply }}" required autofocus>
                                @if ($errors->has('electric_supply'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('electric_supply') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('unit_supply') ? ' has-error' : '' }}">
                                <label>Unit Supply Per Square Meter</label>
                                <input type="text" id="unit_supply" parsley-trigger="change" class="form-control" name="unit_supply" value="{{ $priceSetting->unit_supply }}" required autofocus>
                                @if ($errors->has('unit_supply'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_supply') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="textarea">Description</label>
                                <div>
                                    <textarea id="description" class="form-control parsley-error" name="description" value="" required autofocus>{{ $priceSetting->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-danger waves-effect waves-light btn-submit-price-setting" type="submit">
                                    Update
                                </button>
                                <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-submit-price-setting').click(function (event) {
        event.preventDefault();
        var frm = $('.price-setting-form');

        if(!frm.parsley().validate()){
            return 0;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        frm.ajaxSubmit({
            type: frm.attr('method'),
            url: frm.attr('action'),
            dataType : 'json',
            data: frm.serialize(),
            success: function (data) {
                $('#yorkroup-modal').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                alert("error");
                $('.modal-content').html(xhr.responseText);
            }
        });

        return false;
    });
</script>
    {{--</div>--}}
{{--@endsection--}}
