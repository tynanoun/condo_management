@extends('master')
@section("js")
    <script src="js/customer.js"></script>
@endsection
@section('container')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="m-t-0 header-title">Customer</h4>
                                <p class="text-muted font-14 m-b-20">
                                <ol class="breadcrumb p-0 m-0 pull-left">
                                    <li>
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="active">
                                        Customer
                                    </li>
                                </ol>
                                </p>
                            </div>

                            <div class="col-lg-3 text-center">

                                <p class="text-muted">1,507 / Customer</p>

                                <i class="mdi mdi-account-multiple widget-two-icon"></i>
                            </div>

                            <div class="col-lg-3 text-center">

                                <p class="text-muted">1,507 / Outstanding Invoice</p>

                                <i class="mdi mdi-calendar-multiple-check"></i>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <!-- Add Customer -->
    <div id="add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <i class="fa fa-list panel-ico"></i>
                        <span class="panel-title">ADD NEW CUSTOMER</span>
                    </div>
                    <div class="panel-body">
                        <div class="modal-body">
                            <form action="#" novalidate="">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="userName">First Name<span class="text-danger">*</span></label>
                                                <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="firstname">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="userName">Last Name<span class="text-danger">*</span></label>
                                                <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="lastname">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12  m-t-10">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="userName">Room Number<span class="text-danger">*</span></label>
                                                <select id="heard" required="" class="form-control parsley-error select2 form-control select2-multiple select2-hidden-accessible" required="" data-parsley-id="9" multiple="" data-placeholder="Choose assets." tabindex="-1" aria-hidden="true">
                                                    <option value="">Chooseassets</option>
                                                    <option value="1">001</option>
                                                    <option value="2">005</option>
                                                    <option value="3">109</option>
                                                    <option value="other">Otherassets</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="userName">User Role<span class="text-danger">*</span></label>
                                                <select id="heard" class="form-control parsley-error" required="">
                                                    <option value="">Select</option>
                                                    <option value="1">Administrator</option>
                                                    <option value="2">Accountant</option>
                                                    <option value="3">IT</option>
                                                    <option value="other">Otherassets</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 m-t-10">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                                <input type="email" name="email" parsley-trigger="change" required="" class="form-control" id="emailAddress">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="userName">Phone Number<span class="text-danger">*</span></label>
                                                <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="phone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 m-t-10">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="userName">Ohter contact (Optional)<span class="text-danger">*</span></label>
                                                <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="phone">

                                                <label for="pass1" class="m-t-10">Password<span class="text-danger">*</span></label>
                                                <input id="pass1" type="password" required="" class="form-control">

                                                <label for="passWord2" class="m-t-10">Confirm Password <span class="text-danger">*</span></label>
                                                <input data-parsley-equalto="#pass1" type="password" required=""  class="form-control" id="passWord2">
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 250px; height: 150px;">
                                                        <img src="" alt="image">
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                    <div>
                                                        <button type="button" class="btn btn-default btn-file m-t-10">
                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                            <input type="file" class="btn-default">
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <button class="btn btn-danger waves-effect waves-light" type="submit">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- edit Customer -->
    <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <i class="fa fa-list panel-ico"></i>
                        <span class="panel-title">Edit CUSTOMER</span>
                    </div>
                    <div class="panel-body">
                        <div class="modal-body">
                            <form action="{{ route('register') }}" method="POST" id="customer-form" novalidate="">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="userName">First Name</label>
                                                <input type="text" name="nick" parsley-trigger="change" class="form-control" id="firstname">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="userName">Last Name</label>
                                                <input type="text" name="nick" parsley-trigger="change" class="form-control" id="lastname">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12  m-t-10">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="userName">Room Number</label>
                                                <select id="heard" class="form-control parsley-error select2 form-control select2-multiple select2-hidden-accessible" data-parsley-id="9" multiple="" data-placeholder="Choose assets." tabindex="-1" aria-hidden="true">
                                                    <option value="">Chooseassets</option>
                                                    <option value="1">001</option>
                                                    <option value="2">005</option>
                                                    <option value="3">109</option>
                                                    <option value="other">Otherassets</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="userName">User Role</label>
                                                <select class="form-control parsley-error">
                                                    <option value="">Select</option>
                                                    <option value="1">Administrator</option>
                                                    <option value="2">Accountant</option>
                                                    <option value="3">IT</option>
                                                    <option value="other">Otherassets</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 m-t-10">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="emailAddress">Email address</label>
                                                <input type="email" name="email" parsley-trigger="change"  class="form-control" id="emailAddress">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="userName">Phone Number</label>
                                                <input type="text" name="nick" parsley-trigger="change" class="form-control" id="phone">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 m-t-10">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <label for="userName">Ohter contact (Optional)</label>
                                                <input type="text" name="nick" parsley-trigger="change" class="form-control" id="phone">

                                                <label for="pass1" class="m-t-10">Password</label>
                                                <input id="pass1" type="password" class="form-control">

                                                <label for="passWord2" class="m-t-10">Confirm Password</label>
                                                <input data-parsley-equalto="#pass1" type="password" class="form-control" id="passWord2">
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="width: 250px; height: 150px;">
                                                        <img src="" alt="image">
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                    <div>
                                                        <button type="button" class="btn btn-default btn-file m-t-10">
                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                            <input type="file" class="btn-default">
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <button class="btn btn-danger waves-effect waves-light" type="submit" id="submit">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Delete Customer -->
    <div id="delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content p-0 b-0">
                <div class="panel panel-color panel-inverse">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <i class="fa fa-list panel-ico"></i>
                        <span class="panel-title">Delete CUSTOMER</span>
                    </div>
                    <div class="panel-body">
                        <div class="modal-body">
                            <div class="row">
                                <form action="#" novalidate="">
                                    <h4>Are you sure to delete the customer?</h4>

                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-danger waves-effect waves-light" type="submit">
                                            Delete
                                        </button>
                                        <button type="reset" class="btn btn-inverse waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading font-14">
                    <i class="fa fa-plus-circle"></i>
                    <span class="panel-title" data-toggle="modal" id="add-customer">Add New Customer</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="datatable-keytable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Room#</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Outstanding Invoice</th>
                                <th>Start date</th>
                                <th class="text-center" style="width:5%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>101</td>
                                <td><a href="profile.html">Sarath</a></td>
                                <td>738383</td>
                                <td>1</td>
                                <td>2008/11/13</td>
                                <td class="text-center">
                                    <a href="#" class="table-action-btn edit-row" data-toggle="modal" data-target="#edit"><i class="mdi mdi-pencil"></i></a>
                                    <a href="#" class="table-action-btn text-danger" data-toggle="modal" data-target="#delete"><i class="mdi mdi-close"></i></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div> <!-- container -->
@endsection

<script>






//    var frm = $('#customer-form');
//
//    frm.submit(function (e) {
//
//        e.preventDefault();
//
//        $.ajax({
//            type: frm.attr('method'),
//            url: frm.attr('action'),
//            data: frm.serialize(),
//            success: function (data) {
//                console.log('Submission was successful.');
//                console.log(data);
//            },
//            error: function (data) {
//                console.log('An error occurred.');
//                console.log(data);
//            },
//        });
//    });

</script>
@section('js')

@endsection