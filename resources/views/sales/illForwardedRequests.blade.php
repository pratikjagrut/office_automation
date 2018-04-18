@extends('layouts.app')

@section('title', 'Internet Leased Line Reports')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="well">
					<form action="/illForwardedRequests" method="get">
						<table class="table-condensed">
							<tr class="form-group">
								<td>
									<select class="form-control selectpicker" name="job_id" id="job_id" data-live-search="true" title="Job Id">
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
									<select class="form-control selectpicker" name="customer_name" id="customer_name" data-live-search="true" title="Customer Name">
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
							<b>ILL Final Approval</b>
						</div>
						<div class="panel-body table-responsive">
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
									<th>Generated By</th>
									<th>Feasible</th>
									<th>Fiber</th>
									<th>Rf</th>
									<th>Feasiblity Checked By</th>
									<th>Forwarded By</th>
									<th>Comment</th>
									<th>Approve</th>
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
										<td>{{ ucwords($request->generated_by) }}</td>
										<td>{{ ucwords($request->feasibility_status) }}</td>
										<td>{{ ucwords($request->fiber) }}</td>
										<td>{{ ucwords($request->rf) }}</td>
										<td>{{ ucwords($request->feasibility_checked_by) }}</td>
										<td>{{  ucwords($request->forwarded_by) }}</td>
										<td>{{  ucwords($request->comment) }}</td>
										<td>
											<a class="btn btn-success btn-sm" style="color: white;" data-toggle="modal" data-target="#approveRequest" id="{{$request->id}}" onclick="response(this.id)">Approve</a>
										</td>
									</tr>
								@endforeach
							</table>
						</div>
					</div>
				@else
				    <h2 class="text-center">NO DATA FOUND</h2>	
				@endif
				<div class="text-center">{{$ill_requests->links()}}</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
      <div class="modal fade" id="approveRequest" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><b>Approve Request</b></h4>
            </div>
            <div class="modal-body">
            	<form action="/approveIllRequest" method="post">
                    {{ csrf_field() }}
                    <table class="table-striped table">
                        <tr class="form-group">
                            <td><label>Approval for request:</label></td>
                            <td>
                                <select class="selectpicker form-control" id="approval" name="approval" title="Select" required="true">
                                    <option value="approved">Approve</option>
                                    <option value="denied">Deny</option>
                                    <option value="yes">Back to sales team</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>Comment or Note:</label></td>
                            <td>
                                <textarea name="comment" id="comment" cols="30" rows="3" class="form-control" required="true"></textarea>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td><label>Acted By:</label></td>
                            <td>
                                <input type="text" name="generated_by" value="{{ Auth::user()->name }}" readonly="true" class="form-control">
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td>
                                <input type="hidden" name="requestId" id="requestId">
                            </td>
                            <td>
                                <button type="reset" name="clear" class="btn btn-danger">
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
      	function response(id)
      	{
      		document.getElementById("requestId").value = id
      	}
      </script>
@endsection
