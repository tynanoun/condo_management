@extends('customermaster')
@section('breadcrumbs')
	<div class="col-lg-6">
		<h4 class="m-t-0 header-title">Lease</h4>
		<p class="text-muted font-14 m-b-20">
		<ol class="breadcrumb p-0 m-0 pull-left">
			<li>
				<a href="/usage">Home</a>
			</li>
			<li class="active">
				Lease
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
	            	@if(Auth::user()->hasRole('admin') || Auth::user()->can('leaseInsert')) 
	            		<i class="fa fa-plus-circle"></i>
		                <span class="panel-title">
		                	<a href="lease/create" id="add">Add New Lease</a>
		                </span>
	            	@endif
	            </div>
	            <div class="panel-body">
	                <div class="table-responsive">
	                    <table id="datatable-keytable" class="table table-striped table-bordered">
	                        <thead>
	                        <tr>
	                            <th>Room Number</th>
	                            <th>Start Reading</th>
	                            <th>Start Electric Reading</th>
	                            <th class="text-center" style="width:5%">Action</th>
	                        </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($leases as $lease)
	                        <tr>
	                            <td>{{$lease->room_number}}| {{$lease->first_name}} {{$lease->last_name}}</td>
	                            <td>{{$lease->start_current_reading_electric}}</td>
	                            <td>{{$lease->start_current_reading_water}}</td>
	                            <td class="text-center">
	                            	@if(Auth::user()->hasRole('admin') || Auth::user()->can('leaseView'))
	                            		@if(Auth::user()->can('leaseUpdate'))
	                            			<a href="{{route('lease.edit',$lease->id)}}" class="table-action-btn editLease"><i class="mdi mdi-pencil"></i></a> 
	                            		@else
	                            			<a href="{{route('lease.edit',$lease->id)}}" class="table-action-btn editLease"><i class="fa fa-file-text-o" aria-hidden="true"></i></a> 
	                            		@endif
	                            	@endif
	                            	
	                                @if(Auth::user()->hasRole('admin') || Auth::user()->can('leaseDelete')) 
	                                	<a href="{{$lease->id}}" class="table-action-btn text-danger deleteLease"><i class="mdi mdi-close"></i></a>
	                                @endif
	                            </td>
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
@section('js')
	<script type="text/javascript">
	    $(document).ready(function() {
	    	$(".deleteLease").click(function(event){
	    		event.preventDefault();
				$.ajax({
				    url: 'lease/' + $(this).attr('href'),
				    data: { "_token": "{{ csrf_token() }}" },
				    type: 'DELETE',
				    success: function(result) {
				        if(result== '1'){
				        	location.reload(true)
				        }else{
				        	alert('Error');
				        }
				    }
				});
			});
	    });
	</script>
@endsection