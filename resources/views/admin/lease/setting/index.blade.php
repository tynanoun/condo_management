<div class="modal-content p-0 b-0">
    <div class="panel panel-color panel-inverse">
        <div class="panel-heading">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <i class="fa fa-list panel-ico"></i>
            <span class="panel-title">ADD NEW Lease</span>
        </div>
        <div class="panel-body">
            <div class="modal-body">                                           
                <form action="#" novalidate="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Start Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" required="">
                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label>End Date <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" required="">
                                        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 m-t-20">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="userName">Room Discount<span class="text-danger">*</span></label>
                                    <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="firstname">
                                </div>
                                <div class="col-sm-6">
                                    <label for="userName">Room Whole<span class="text-danger">*</span></label>
                                    <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="lastname">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 m-t-20">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <label for="userName">Electric Discount<span class="text-danger">*</span></label>
                                    <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="firstname">
                                </div>
                                <div class="col-sm-6">
                                    <label for="userName">Electric Whole<span class="text-danger">*</span></label>
                                    <input type="text" name="nick" parsley-trigger="change" required="" class="form-control" id="lastname">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 m-t-20">
                            <div class="form-group">
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
</div>