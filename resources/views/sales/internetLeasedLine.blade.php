@extends('layouts.app')

@section('title', 'Internet Leased Line Reports')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="well">
					<form action="/internetLeasedLine" method="get">
						<table class="table-condensed">
							<tr class="form-group">
								<td>
									<select class="form-control selectpicker" name="job_id" id="job_id1" data-live-search="true" title="Job Id">
										@if (count($ill_requests) > 0)
									        @foreach ($ill_requests as $ill_request)
									            @if ($ill_request->job_id != null)
									            	<option data-tokens="{{$ill_request->job_id}}" value="{{$ill_request->job_id}}">{{ucwords($ill_request->job_id)}}
									            	</option>
									            @endif
									        @endforeach     
									    @endif
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="customer_name" id="customer_name1" data-live-search="true" title="Customer Name">
										@if (count($customers) > 0)
									        @foreach ($customers as $customer)
									            @if ($customer->customer_name != null)
									            	<option data-tokens="{{$customer->customer_name}}" value="{{$customer->customer_name}}">{{ucwords($customer->customer_name)}}
									            	</option>
									            @endif
									        @endforeach     
									    @endif
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="contact_person_name" id="contact_person_name" data-live-search="true" title="Cont. P. Name">
										@if (count($contact_person_names) > 0)
									        @foreach ($contact_person_names as $contact_person_name)
									            @if ($contact_person_name->contact_person_name != null)
									            	<option data-tokens="{{$contact_person_name->contact_person_name}}" value="{{$contact_person_name->contact_person_name}}">{{ucwords($contact_person_name->contact_person_name)}}
									            	</option>
									            @endif
									        @endforeach     
									    @endif
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="customer_city" id="customer_city" data-live-search="true" title="City">
										@if (count($cities) > 0)
									        @foreach ($cities as $city)
									            @if ($city->customer_city != null)
									            	<option data-tokens="{{$city->customer_city}}" value="{{$city->customer_city}}">{{ucwords($city->customer_city)}}
									            	</option>
									            @endif
									        @endforeach     
									    @endif
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="feasibility_status" id="feasibility_status" title="Feasibility">
										<option value="no">No</option>
										<option value="not decided">Not Decided</option>
									</select>
								</td>
								<td>
									<button type="submit" name="filter" class="btn btn-info">Search</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				@if (count($ill_requests) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center">
							<b>ILL New Connections Request</b>
						</div>
						<div class="panel-body table-responsive">
							<form action="/deleteIllRequests" method="post">
								{{ csrf_field() }}
								<table class="table table-striped table-bordered table-condensed" style="border: 1px solid #ccc;">
									<tr>
										<th>Sr. No</th>
										<th>Job Id</th>
										<th>Customer Name</th>
										<th>Customer Address</th>
										<th>City</th>
										<th>State</th>
										<th>Pincode</th>
										<th>Cont. P. Name</th>
										<th>Cont. P. Number</th>
										<th>Cont. P. Email</th>
										<th>Bandwidth Size</th>
										@if (Auth()->user()->department == 'sales')
											<th>Edit</th>
										@endif
										<th>Generated By</th>
										<th>Feasible</th>
										<th>Fiber</th>
										<th>Rf</th>
										<th>Feasiblity Checked By</th>
										@if (Auth::user()->department == 'networking')
											<th>Response</th>
										@endif
										<th>Delete</th>
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
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										@if (Auth::user()->user_type == 'admin')
											<td>
												<input type="checkbox" id="deleteCkbCheckAll"/>
											</td>
					                    @endif
									</tr>
									@foreach ($ill_requests as $request)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{ ucwords($request->job_id) }}</td>
											<td>{{ ucwords($request->customer_name) }}</td>
											<td>{{ ucwords($request->customer_address) }}</td>
											<td>{{ ucwords($request->customer_city) }}</td>
											<td>{{ ucwords($request->customer_state) }}</td>
											<td>{{ ucwords($request->pincode) }}</td>
											<td>{{ ucwords($request->contact_person_name) }}</td>
											<td>{{ ucwords($request->contact_person_no) }}</td>
											<td>{{ ucwords($request->contact_person_email) }}</td>
											<td>{{ ucwords($request->bandwidth_size) }}</td>
											@if (Auth::user()->name == $request->generated_by)
												<td>
													<a class="btn btn-primary btn-sm" style="color: white;" data-toggle="modal" data-target="#editRequest" id="{{$request->id}}" onclick="getData(this.id)">Edit</a>
												</td>
											@endif
											<td>{{ ucwords($request->generated_by) }}</td>
											<td>{{ ucwords($request->feasibility_status) }}</td>
											<td>{{ ucwords($request->fiber) }}</td>
											<td>{{ ucwords($request->rf) }}</td>
											<td>{{ ucwords($request->feasibility_checked_by) }}</td>
											@if (Auth::user()->department == 'networking')
												<td>
													<a class="btn btn-success btn-sm" style="color: white;" data-toggle="modal" data-target="#respondRequest" id="{{$request->id}}" onclick="response(this.id)">Response</a>
												</td>
											@endif
											<td>
												@if (Auth::user()->name == $request->generated_by)
													<input type="checkbox" name="delete[]" value="{{$request->id}}" class="deleteCheckBox">
												@endif
											</td>
										</tr>
									@endforeach
									<tr>
										<td colspan="17"></td>
										<td>
											<input type="submit" name="deleteIllRequests" value="delete" class="btn btn-danger">
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				@else
				    <h2 class="text-center">NO DATA FOUND</h2>	
				@endif
				<div class="text-center">{{$ill_requests->links()}}</div
			</div>
		</div>
	</div>

	<!-- Modal -->
      <div class="modal fade" id="editRequest" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><b>Edit New Connection Request</b></h4>
            </div>
            <div class="modal-body">
                <form action="/editConnectionRequest" method="post">
                    {{csrf_field()}}
                    <table class="table table-striped">
                    	<tr class="form-group">
							<td><label>Job Id:</label></td>
							<td>
								<input type="text" name="job_id" id="job_id" class="form-control" readonly="true" >
							</td>
						</tr>
                        <tr class="form-group">
							<td><label>Customer Name:</label></td>
							<td>
								<input type="text" name="customer_name" id="customer_name" class="form-control" >
							</td>
						</tr>
						<tr class="form-group">
							<td><label>Customer Address: </label></td>
							<td>
								<input id="customer_address" type="text" class="form-control" name="customer_address"  >
							</td>
						</tr>
						<tr class="form-group">
							<td><label>City: </label></td>
							<td>
								<input id="city" type="text" class="form-control" name="city" >
							</td>
						</tr>
						<tr class="form-group">
							<td><label>State: </label></td>
							<td>
								<input id="state" type="text" class="form-control" name="state" >
							</td>
						</tr>
						<tr class="form-group">
							<td><label>Pincode: </label></td>
							<td>
								<input id="pincode" type="tel" class="form-control" name="pincode" >
							</td>
						</tr>

						<tr class="form-group">
							<td><label>Contact Person Name: </label></td>
							<td>
								<input id="contact_person_name" type="text" class="form-control" name="contact_person_name" >
							</td>
						</tr>
						<tr class="form-group">
							<td><label>Contact Person Number: </label></td>
							<td>
								<input id="contact_person_number" type="tel" class="form-control" name="contact_person_number" >
							</td>
						</tr>
						<tr class="form-group">
							<td><label>Contact Person Email: </label></td>
							<td>
								<input id="contact_person_email" type="email" class="form-control" name="contact_person_email" >
							</td>
						</tr>
						<tr class="form-group">
							<td><label>Bandwidth Size: </label></td>
							<td>
								<input id="bandwidth_size" type="number" min="1" class="form-control" name="bandwidth_size"  >
							</td>
						</tr>
						<tr class="form-group">
							<td>
								<input type="hidden" name="requestId" id="requestId">
							</td>
							<td>
								<button type="clear" name="clear" class="btn btn-danger">
									Clear!
								</button>
                                <button type="submit" name="submit" class="btn btn-primary">
                                	Submit
                                </button>
							</td>
						</tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="respondRequest" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><b>Feasibility Check</b></h4>
            </div>
            <div class="modal-body">
                <form action="/fesibilityCheck" method="post">
                	{{ csrf_field() }}
                	<table class="table-striped table">
                		<tr class="form-group">
                			<td><label>Feasible:</label></td>
                			<td>
                				<select class="selectpicker form-control" id="feasibility_status" name="feasibility_status" title="Select Feasibility Status">
                					<option value="yes">Yes</option>
                					<option value="no">No</option>
                					<option value="not decided">Not Decided</option>
                				</select>
                			</td>
                		</tr>
                		<tr class="form-group">
                			<td><label>Fiber:</label></td>
                			<td>
                				<input type="text" name="fiber" id="fiber" class="form-control">
                			</td>
                		</tr>
                		<tr class="form-group">
                			<td><label>Rf:</label></td>
                			<td>
                				<input type="text" name="rf" id="rf" class="form-control">
                			</td>
                		</tr>
                		<tr class="form-group">
                			<td><label>Generated By:</label></td>
                			<td>
                				<input type="text" name="generated_by" value="{{ Auth::user()->name }}" readonly="true" class="form-control">
                			</td>
                		</tr>
                		<tr class="form-group">
							<td>
								<input type="hidden" name="requestId" id="requestId1">
							</td>
							<td>
								<button type="clear" name="clear" class="btn btn-danger">
									Clear!
								</button>
                                <button type="submit" name="submit" class="btn btn-primary">
                                	Submit
                                </button>
							</td>
						</tr>
                	</table>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>

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

	<script type="text/javascript">
          function getData(id)
          {     
                $.get("{{URL::to('internetLeasedLine/readData')}}/"+id, function(data){
                    console.log(data)
                    document.getElementById("requestId").value = id
            		document.getElementById("job_id").value = data['job_id']
            		document.getElementById("customer_name").value = data['customer_name']
            		document.getElementById("customer_address").value = data['customer_address']
            		document.getElementById("city").value = data['customer_city']
            		document.getElementById("state").value = data['customer_state']
            		document.getElementById("pincode").value = data['pincode']
            		document.getElementById("contact_person_name").value = data['contact_person_name']
            		document.getElementById("contact_person_number").value = data['contact_person_no']
            		document.getElementById("contact_person_email").value = data['contact_person_email']        
            		document.getElementById("bandwidth_size").value = data['bandwidth_size']        
                })
          }
      </script>

      <script type="text/javascript">
      	function response(id)
      	{
      		document.getElementById("requestId1").value = id
      	}
      </script>
@endsection
