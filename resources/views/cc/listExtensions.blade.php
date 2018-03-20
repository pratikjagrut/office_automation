@extends('layouts.app')

@section('title', 'Extension')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="well">
					<form action="/listExtensions" class="form-inline" method="get">
						<table class="table-condensed">
							<tr class="form-group">
								<td>
									<select class="form-control selectpicker" name="customer_id" id="customer_id" data-live-search="true" title="Customer Id">
									    @if (count($customers) > 0)
									        @foreach ($customers as $customer)
									            <option data-tokens="{{$customer->customer_id}}" value="{{$customer->customer_id}}">{{ucwords($customer->customer_id)}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="assigned_to" id="assigned_to" data-live-search="true" title="Assigned To">
									    @if (count($engineers) > 0)
									        @foreach ($engineers as $engineer)
									            <option data-tokens="{{$engineer->assigned_to}}" value="{{$engineer->assigned_to}}">{{ucwords($engineer->assigned_to)}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<select class="selectpicker form-control" name="status" id="status" title="Status">
										<option value="pending">Pending</option>
										<option value="granted">Granted</option>
										<option value="rejected">Rejected</option>
									</select>
								</td>
								<td>
									<input placeholder="Complaint Date" class="form-control" type="text" onfocus="(this.type='date')" name="complaint_date" onblur="(this.type='text')">
								</td>
								<td>
									<button type="submit" name="filter" class="btn btn-info">Search</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div class="col-md-4 col-sm-4"></div>
			<div class="col-md-2 col-sm-2">
				<div class="well text-center">
					<a href="/exportExtensions" class="btn btn-warning">Export</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if (count($extensions) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center"><b>Extensions</b></div>
						<div class="panel-body table-responsive">
							<form action="/operationOnExtensions" method="post">
								{{csrf_field()}}
								<table class="table table-striped table-bordered" style="border: 1px solid #ccc;" id="output">
									<tr id="row">
										<th>Sr .No</th>
										<th>Customer Id</th>
										<th>Complaint Date</th>
										<th>Expiry Date</th>
										<th>Reason</th>
										<th>Extension Days</th>
										<th>Assigned To</th>
										<th>Status</th>
										<th>Generated By</th>
										<th>Acted By</th>
										<th>Rejection Note</th>
										@if (Auth::user()->user_type == 'admin')
											<th>Grant</th>
											<th>Reject</th>
											<th>Delete</th>
										@endif
									</tr>
									<tr>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    <td></td>
					                    @if (Auth::user()->user_type == 'admin')
					                      <td>
					                      	<input type="checkbox" id="grantCkbCheckAll" />
					                      </td>
					                      <td></td>
					                      <td>
					                      	<input type="checkbox" id="deleteCkbCheckAll"/></td>
					                    @endif
					                </tr> 
									@foreach ($extensions as $extension)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{ucwords($extension->customer_id)}}</td>
											<td>{{ucwords($extension->complaint_date)}}</td>
											<td>{{ucwords($extension->expiry_date)}}</td>
											<td>{{ucwords($extension->reason)}}</td>
											<td>{{ucwords($extension->extension_day)}}</td>
											<td>{{ucwords($extension->assigned_to)}}</td>
											<td>{{ucwords($extension->status)}}</td>
											<td>{{ucwords($extension->generated_by)}}</td>
											<td>{{ucwords($extension->granted_by)}}</td>
											<td>{{$extension->rejection_note}}</td>
											@if (Auth::user()->user_type == 'admin')
												<td>
												<input type="checkbox" name="grant[]" value="{{$extension->id}}" class="grantCheckBox">
												</td>
												<!--<td>
													<input type="checkbox" name="reject[]" value="{//{$extension->id}}">	
												</td>-->
												<td>
													<a class="btn btn-primary btn-sm" style="color: white;" data-toggle="modal" data-target="#rejectExtension" id="{{$extension->customer_id}}/{{$extension->id}}" onclick="clck(this.id)">Reject</a>
												</td>
												<td>
													<input type="checkbox" name="delete[]" value="{{$extension->id}}" class="deleteCheckBox">
												</td>
											@endif
										</tr>
									@endforeach		
								</table>
								@if (Auth::user()->user_type == 'admin')
									<input type="hidden" name="granted_by" value="{{Auth::user()->name}}">
									<input type="submit" class="btn btn-danger pull-right" name="">
								@endif
							</form>
						</div>
					</div>
					@else
						<h2 class="text-center">NO DATA FOUND</h2>	
				@endif
				<div class="text-center">{{$extensions->links()}}</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	  <div class="modal fade" id="rejectExtension" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center"><b>Reject Extension</b></h4>
	        </div>
	        <div class="modal-body">
				<form action="/rejectExtension" method="post">
					{{csrf_field()}}
					<table class="table table-striped">
						<tr class="form-group">
							<td><label>Customer Id:</label></td>
							<td>
								<input type="text" name="customer_id" class="form-control" readonly="true" id="customer_id1">
							</td>
						</tr>
						<tr class="form-group">
							<td><label>Reason:</label></td>
							<td>
								<textarea id="rejection_note" class="form-control" name="rejection_note" rows="4" cols="50">
								</textarea>
							</td>
						</tr>
						<tr class="form-group">
							<td><label>Rejected By</label></td>
							<td>
								<input type="text" name="rejected_by" class="form-control" value="{{auth()->user()->name}}" readonly="true">
							</td>
						</tr>
						<tr class="form-group">
							<td>
								<input type="hidden" name="extension_id" id="extension_id">
							</td>
							<td>
								<input type="submit" class="btn btn-danger" value="Reject">
							</td>
						</tr>
					</table>
				</form>
	        </div>
	        </div>
	      </div>
	      
	    </div>
	  </div>
<script type="text/javascript">
	function clck(id)
	{	
		var data = id.split('/')
		document.getElementById("customer_id1").value = data[0]
		document.getElementById("extension_id").value = data[1]
	}
</script>

<script type="text/javascript">
	//select all grant checkbox 
	$(document).ready(function () {
	    $("#grantCkbCheckAll").click(function () {
	        $(".grantCheckBox").prop('checked', $(this).prop('checked'));
	    });
	    
	    $(".grantCheckBox").change(function(){
	        if (!$(this).prop("checked")){
	            $("#grantCkbCheckAll").prop("checked",false);
	        }
	    });
	});
</script>

<script type="text/javascript">
	//select all delete checkbox 
	$(document).ready(function () {
	    $("#deleteCkbCheckAll").click(function () {
	        $(".deleteCheckBox").prop('checked', $(this).prop('checked'));
	    });
	    
	    $(".deleteCheckBox").change(function(){
	        if (!$(this).prop("checked")){
	            $("#deleteCkbCheckAll").prop("checked",false);
	        }
	    });
	});
</script>
@endsection