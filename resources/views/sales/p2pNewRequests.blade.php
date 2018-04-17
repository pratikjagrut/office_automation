@extends('layouts.app')

@section('title', 'Manage Services Reports')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-8">
                <div class="well">
                    <form action="/p2pNewRequests" method="get">
                        <table class="table-condensed">
                            <tr class="form-group">
                                <td>
                                    <select class="form-control selectpicker" name="job_id" id="job_id1" data-live-search="true" title="Job Id">
                                        @if (count($p2p_requests) > 0)
                                            @foreach ($p2p_requests as $p2p_request)
                                                @if ($p2p_request->job_id != null)
                                                    <option data-tokens="{{$p2p_request->job_id}}" value="{{$p2p_request->job_id}}">{{ucwords($p2p_request->job_id)}}
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
            <div class="col-md-4">
                <div class="well text-center">
                    <a href="/exportNewP2pRequests" class="btn btn-warning">Export</a>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				@if (count($p2p_requests) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center">
							<b>Manage services</b>
						</div>
						<div class="panel-body table-responsive">
							<form action="/deletep2pRequests" method="post">
								{{ csrf_field() }}
								<table class="table table-striped table-bordered table-condensed" style="border: 1px solid #ccc;">
									<tr>
										<th>Sr. No</th>
										<th>Job Id</th>
										<th>Customer Name</th>
										<th>Cont. P. Name</th>
										<th>Cont. P. Number</th>
										<th>Cont. P. Email</th>
										<th>A end Address</th>
										<th>A end City</th>
										<th>A end State</th>
										<th>A end Pincode</th>
										<th>A end Lat/Long</th>
										<th>B end Address</th>
										<th>B end City</th>
										<th>B end State</th>
										<th>B end Pincode</th>
										<th>B end Lat/Long</th>
										<th>Network Priority</th>
										<th>Other Requirments</th>
										<th>Generated By</th>
										{{-- @if (Auth()->user()->department == 'sales')
											<th>Edit</th>
										@endif --}}
										{{-- <th>Edit</th> --}}
										<th>A end feasibility</th>
										<th>B end feasibility</th>
										<th>Overall Feasiblity</th>
										<th>BTS Address</th>
										<th>Feasiblity Checked By</th>
                                        <th>Comment</th>
										@if (Auth::user()->department == 'networking')
											<th>Response</th>
										@endif
										{{-- <th>Response</th> --}}
										<th>Delete</th>
									</tr>
									<tr>
										<td colspan="25"></td>
										@if (Auth::user()->user_type == 'admin')
											<td>
												<input type="checkbox" id="deleteCkbCheckAll"/>
											</td>
					                    @endif
									</tr>
									@foreach ($p2p_requests as $request)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{ ucwords($request->job_id) }}</td>
											<td>{{ ucwords($request->customer_name) }}</td>
											<td>{{ ucwords($request->contact_person_name) }}</td>
											<td>{{ ucwords($request->contact_person_no) }}</td>
											<td>{{ ucwords($request->contact_person_email) }}</td>
											<td>{{ ucwords($request->a_end_address) }}</td>
											<td>{{ ucwords($request->a_end_city) }}</td>
											<td>{{ ucwords($request->a_end_state) }}</td>
											<td>{{ ucwords($request->a_end_pincode) }}</td>
											<td>{{ ucwords($request->a_end_lat_long) }}</td>
											<td>{{ ucwords($request->b_end_address) }}</td>
											<td>{{ ucwords($request->b_end_city) }}</td>
											<td>{{ ucwords($request->b_end_state) }}</td>
											<td>{{ ucwords($request->b_end_pincode) }}</td>
											<td>{{ ucwords($request->b_end_lat_long) }}</td>
											<td>{{ ucwords($request->network_priority) }}</td>
											<td>{{ ucwords($request->other_requirments) }}</td>
											<td>{{ ucwords($request->generated_by) }}</td>
											{{-- @if (Auth::user()->name == $request->generated_by)
												<td>
													<a class="btn btn-primary btn-sm" style="color: white;" data-toggle="modal" data-target="#editRequest" id="{{$request->id}}" onclick="getData(this.id)">Edit</a>
												</td>
											@endif --}}
											{{-- <td>
												<a class="btn btn-primary btn-sm" style="color: white;" data-toggle="modal" data-target="#editRequest" id="{{$request->id}}" onclick="getData(this.id)">Edit</a>
											</td> --}}
											<td>{{ ucwords($request->a_end_feasibility) }}</td>
											<td>{{ ucwords($request->b_end_feasibility) }}</td>
											<td>{{ ucwords($request->feasibility_status) }}</td>
											<td>{{ ucwords($request->bts_address) }}</td>
											<td>{{ ucwords($request->feasibility_checked_by) }}</td>
                                            <td>{{ $request->comment }}</td>
											@if (Auth::user()->department == 'networking')
												<td>
													<a class="btn btn-success btn-sm" style="color: white;" data-toggle="modal" data-target="#respondRequest" id="{{$request->id}}" onclick="response(this.id)">Response</a>
												</td>
											@endif
											{{-- <td>
												<a class="btn btn-success btn-sm" style="color: white;" data-toggle="modal" data-target="#respondRequest" id="{{$request->id}}" onclick="response(this.id)">Response</a>
											</td> --}}
											<td>
												@if (Auth::user()->name == $request->generated_by)
													<input type="checkbox" name="delete[]" value="{{$request->id}}" class="deleteCheckBox">
												@endif
											</td>
										</tr>
									@endforeach
									<tr>
										<td colspan="25"></td>
										<td>
											<input type="submit" name="deletep2pRequests" value="delete" class="btn btn-danger">
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				@else
				    <h2 class="text-center">NO DATA FOUND</h2>	
				@endif
				<div class="text-center">{{$p2p_requests->links()}}</div
			</div>
		</div>
	</div>

	{{--
      <div class="modal fade" id="editRequest" role="dialog">
        <div class="modal-dialog">
        
         
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><b>Edit New Connection Request</b></h4>
            </div>
            <div class="modal-body">
                <form action="/editP2pConnectionRequest" method="post">
                    {{csrf_field()}}
                    <table class="table table-striped">
                    	<tr class="form-group">
                            <td><label>Job Id: </label></td>
                            <td>
                                <input id="job_id" type="text" class="form-control" name="job_id" readonly="true">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>Customer Name: </label></td>
                            <td>
                                <input id="customer_name" type="text" class="form-control" name="customer_name" >
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
                            <td><label>A end Address: </label></td>
                            <td>
                                <input id="a_end_address" type="text" class="form-control" name="a_end_address"  >  
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>A end City: </label></td>
                            <td>
                                <input id="a_end_city" type="text" class="form-control" name="a_end_city" >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>A end State: </label></td>
                            <td>
                                <input id="a_end_state" type="text" class="form-control" name="a_end_state" >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>A end Pincode: </label></td>
                            <td>
                                <input id="a_end_pincode" type="tel" class="form-control" name="a_end_pincode" >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>A end lat/long: </label></td>
                            <td>
                                <input id="a_end_lat_long" type="text" class="form-control" name="a_end_lat_long"  >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>B end Address: </label></td>
                            <td>
                                <input id="b_end_address" type="text" class="form-control" name="b_end_address"  >  
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>B end City: </label></td>
                            <td>
                                <input id="b_end_city" type="text" class="form-control" name="b_end_city"  >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>B end State: </label></td>
                            <td>
                                <input id="b_end_state" type="text" class="form-control" name="b_end_state" >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>B end Pincode: </label></td>
                            <td>
                                <input id="b_end_pincode" type="tel" class="form-control" name="b_end_pincode" >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>B end lat/long: </label></td>
                            <td>
                                <input id="b_end_lat_long" type="text" class="form-control" name="b_end_lat_long"  >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>Network Priority: </label></td>
                            <td>
                                <input id="network_priority" type="text" class="form-control" name="network_priority" >
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>Other Requirments: </label></td>
                            <td>
                                <textarea id="other_requirments" class="form-control" name="other_requirments" cols="30" rows="3"></textarea>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>Generated By: </label></td>
                            <td>
                                <input type="text" name="generated_by" id="generated_by" value="{{ Auth::user()->name }}" readonly="true" class="form-control" >
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
 --}}
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
                <form action="/p2pFesibilityCheck" method="post">
                	{{ csrf_field() }}
                	<table class="table-striped table">
                		<tr class="form-group">
                			<td><label>A End Feasibility:</label></td>
                			<td>
                				<select class="selectpicker form-control" name="a_end_feasibility" title="Select Feasibility">
                					<option value="yes">Yes</option>
                					<option value="no">No</option>
                					<option value="not decided">Not Decided</option>
                				</select>
                			</td>
                		</tr>
                		<tr class="form-group">
                			<td><label>B End Feasibility:</label></td>
                			<td>
                				<select class="selectpicker form-control" name="b_end_feasibility" title="Select Feasibility">
                					<option value="yes">Yes</option>
                					<option value="no">No</option>
                					<option value="not decided">Not Decided</option>
                				</select>
                			</td>
                		</tr>
                		<tr class="form-group">
                			<td><label>Overall Feasibility:</label></td>
                			<td>
                				<select class="selectpicker form-control" name="feasibility_status" title="Select Feasibility">
                					<option value="yes">Yes</option>
                					<option value="no">No</option>
                					<option value="not decided">Not Decided</option>
                				</select>
                			</td>
                		</tr>
                		<tr class="form-group">
                			<td><label>Bts Address:</label></td>
                			<td>
                                <textarea id="bts_address" class="form-control" name="bts_address" cols="30" rows="3"></textarea>
                            </td>
                		</tr>
                		<tr class="form-group">
                			<td><label>Comment:</label></td>
                			<td>
                                <textarea id="comment" class="form-control" name="comment" cols="30" rows="3"></textarea>
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

	{{-- <script type="text/javascript">
          function getData(id)
          {     
                $.get("{{URL::to('p2pNewRequests/readData')}}/"+id, function(data){
                    console.log(data)
                    document.getElementById("requestId").value = id
            		document.getElementById("job_id").value = data['job_id']
            		document.getElementById("customer_name").value = data['customer_name']

            		document.getElementById("contact_person_name").value = data['contact_person_name']
            		document.getElementById("contact_person_number").value = data['contact_person_no']
            		document.getElementById("contact_person_email").value = data['contact_person_email'] 

            		document.getElementById("a_end_address").value = data['a_end_address']
            		document.getElementById("a_end_city").value = data['a_end_city']
            		document.getElementById("a_end_state").value = data['a_end_state']
            		document.getElementById("a_end_pincode").value = data['a_end_pincode']
            		document.getElementById("a_end_lat_long").value = data['a_end_lat_long']

            		document.getElementById("b_end_address").value = data['b_end_address']
            		document.getElementById("b_end_city").value = data['b_end_city']
            		document.getElementById("b_end_state").value = data['b_end_state']
            		document.getElementById("b_end_pincode").value = data['b_end_pincode']
            		document.getElementById("b_end_lat_long").value = data['b_end_lat_long']
            		document.getElementById("network_priority").value = data['network_priority']
            		document.getElementById("other_requirments").value = data['other_requirments']        
                })
          }
      </script> --}}

      <script type="text/javascript">
      	function response(id)
      	{
      		document.getElementById("requestId1").value = id
      	}
      </script>
@endsection
