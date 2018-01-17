<?php

$name = '';
$displayName = '';
$isStaff = false;
$description = '';

$action = action('RoleController@store');
if (isset($isEdit) && $isEdit && isset($role) && $role != null) {
    $name = $role->name;
    $displayName = $role->display_name;
    $isStaff = $role->is_staff;
    $description = $role->description;
    $action = action('RoleController@update', $role->id);
}
?>

<div class="panel panel-color panel-inverse">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <i class="fa fa-list panel-ico"></i>
        <span class="panel-title">Edit Role</span>
    </div>
    <div class="panel-body">
        <div class="modal-body">
            <div class="row">
                <form class="form-horizontal role-form" method="POST" action="{{$action}}">
                    {{ csrf_field() }}
                    @if(isset($isEdit) && $isEdit && isset($role) && $role != null)
                    <input name="_method" type="hidden" value="PATCH">
                    @endif
                    <div class="row">
                        <div class="col-sm-12  m-t-10">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="userName">Name<span class="text-danger">*</span></label>
                                    @if(isset($isEdit) && $isEdit && isset($role) && $role != null)
                                    <input id="name" disabled type="text" class="form-control" name="name" value="{{$name}}">
                                    @else
                                        <input id="name" type="text" class="form-control" name="name" value="{{$name}}">
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="userName">Display Name<span class="text-danger">*</span></label>
                                    <input id="display_name" type="text" class="form-control" parsley-trigger="change" required="" name="display_name" value="{{$displayName}}" autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12  m-t-10">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="checkbox checkbox-inline">
                                        @if($isStaff)
                                            <input type="checkbox" checked name="is_staff" id="is_staff" value="1">
                                        @else
                                            <input type="checkbox" name="is_staff" id="is_staff" value="1">
                                        @endif
                                        <label for="is_staff"> Is Staff </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12  m-t-10">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <label for="textarea">Description</label>
                                    <textarea id="description" type="text" class="form-control" name="description" value="{{$description}}">{{$description}}</textarea>
                                </div>
                                <div class="col-sm-12">
                                    <p class="font-16 m-b-15 m-t-10">Permission</p>
                                    <?php
                                    $category = '';
                                    ?>
                                    @foreach($permissions as $permission)
                                        <?php $isSelected = false; ?>
                                        @if($category != $permission->category_name)
                                </div>
                                @endif
                                @if($category == '' || $category != $permission->category_name)
                                    <div class="col-md-4">
                                        <?php
                                        $category = $permission->category_name;
                                        ?>
                                        {{$permission->category_name}}<br>
                                        @endif
                                        @if(isset($selectedPermissions) && $selectedPermissions != null && count($selectedPermissions) > 0)
                                            @foreach($selectedPermissions as $selectedPermission)
                                                <?php
                                                if($permission->id === $selectedPermission->permission_id) {
                                                    $isSelected = true;
                                                }

                                                ?>
                                            @endforeach
                                        @endif
                                        <input type="checkbox"  name="permission[]" id="permission-{{ $permission->id}}" {{$isSelected ? 'checked' : ''}} value="{{ $permission->id }}">
                                        <label for="permission-{{ $permission->id}}"> {{$permission->display_name}} </label> <br/>
                                        @endforeach
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-danger waves-effect waves-light btn-submit-role" type="submit">Submit</button>
                        <button type="reset" class="btn btn-inverse waves-effect m-l-5">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('.btn-submit-role').click(function (event) {
        event.preventDefault();
        var frm = $('.role-form');

        if(!frm.parsley().validate()){
            return 0;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            dataType : 'json',
            data: frm.serialize(),
            success: function (data) {
                $('#yorkroup-modal').modal('hide');
                location.reload();
            },
            error: function (xhr, status, error) {
                $('.modal-content').html(xhr.responseText);
            }
        });

        return false;
    });

</script>
