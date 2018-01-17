<div class="modal-dialog modal-full">
    <div class="modal-content p-0 b-0">
        <div class="panel panel-color panel-inverse">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <i class="fa fa-list panel-ico"></i>
                <span class="panel-title">Work Order</span>
            </div>
            <div class="panel-body">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <img src="assets/images/logo_dark.png" alt="" height="30">
                                    </div>
                                    <div class="pull-right">
                                        <h3 class="m-0 hidden-print">Work Order</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="pull-left m-t-30">
                                            <p><b>Hello, Stanley Jones</b></p>
                                            <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                                promises to provide high quality products for you as well as outstanding
                                                customer service for every transaction. </p>
                                        </div>

                                    </div><!-- end col -->
                                    <div class="col-sm-3 col-sm-offset-3 col-xs-4 col-xs-offset-2">
                                        <div class="m-t-30 pull-right">
                                            <p><small><strong>Order Date: </strong></small> Jan 17, 2016</p>
                                            <p><small><strong>Order Status: </strong></small>Paid</p>
                                            <p><small><strong>Order ID: </strong></small> #123456</p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->
                                <div class="row m-t-30">
                                    <div class="col-xs-6">
                                        <h5>Billing Address</h5>

                                        <address class="line-h-24">
                                            Stanley Jones<br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>

                                    </div>

                                    <div class="col-xs-6">
                                        <h5>Shipping Address</h5>

                                        <address class="line-h-24">
                                            Stanley Jones<br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            <abbr title="Phone">P:</abbr> (123) 456-7890
                                        </address>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Taske Name</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Name of Room</th>
                                                        <th>Assigned to</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($maintenance as $row)
                                                        <tr>
                                                            <td>{{$row->id}}</td>
                                                            <td>{{$row->task_name}}</td>
                                                            <td>{{$row->start_date}}</td>
                                                            <td>{{$row->end_date}}</td>
                                                            <td>{{$row->room_number}}</td>
                                                            <td>{{$row->first_name}} {{$row->last_name}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8 ">
                                        <div class="form-group">
                                            <label>Comments</label>
                                            <textarea class="form-control print-clean" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <b style="padding-right: 76px;"><u>Signature</u></b>
                                    </div>
                                </div>
                                <div class="hidden-print m-t-30 m-b-30" style="position: fixed; bottom: 10px; width: 350px; right: 18px;">
                                    <div class="text-right">
                                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                                        <button type="button" class="btn default"><i class="fa fa-paper-plane m-r-5" aria-hidden="true"></i>Send</button>
                                        @if(Auth::user()->hasRole('admin') || Auth::user()->can('download_maintenance')) 
                                            <button class="btn default" onclick="HTMLtoPDF()"><i class="fa fa-download m-r-5" aria-hidden="true"></i>Download</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal-content -->