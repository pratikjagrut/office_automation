@extends('layouts.app')

@section('title', 'Manage Services Reports')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="well">
                    <form action="/p2pFeasibleRequests" method="get">
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
				@if (count($p2p_requests) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center">
							<b>Manage services Senior's Approval</b>
						</div>
						<div class="panel-body table-responsive">
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
                                    <th>A end feasibility</th>
                                    <th>B end feasibility</th>
                                    <th>Overall Feasiblity</th>
                                    <th>BTS Address</th>
                                    <th>Feasiblity Checked By</th>
                                    <th>Comment</th>
                                    {{-- @if (Auth::user()->department == 'networking')
                                        <th>Response</th>
                                    @endif --}}
                                    <th>Forward</th>
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
                                        <td>{{ ucwords($request->a_end_feasibility) }}</td>
                                        <td>{{ ucwords($request->b_end_feasibility) }}</td>
                                        <td>{{ ucwords($request->feasibility_status) }}</td>
                                        <td>{{ ucwords($request->bts_address) }}</td>
                                        <td>{{ ucwords($request->feasibility_checked_by) }}</td>
                                        <td>{{ $request->comment }}</td>
                                        {{-- @if (Auth::user()->department == 'networking')
                                            <td>
                                                <a class="btn btn-success btn-sm" style="color: white;" data-toggle="modal" data-target="#respondRequest" id="{{$request->id}}" onclick="response(this.id)">Response</a>
                                            </td>
                                        @endif --}}
                                        <td>
                                            <a class="btn btn-success btn-sm" style="color: white;" data-toggle="modal" data-target="#forwardRequest" id="{{$request->id}}" onclick="response(this.id)">Forward</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
						</div>
					</div>
				@else
				    <h2 class="text-center">NO DATA FOUND</h2>	
				@endif
				<div class="text-center">{{$p2p_requests->links()}}</div
			</div>
		</div>
	</div>
    
        <!-- Modal -->
          <div class="modal fade" id="forwardRequest" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center"><b>Forward Request</b></h4>
                </div>
                <div class="modal-body">
                    <form action="/forwardP2pRequest" method="post">
                        {{ csrf_field() }}
                        <table class="table-striped table">
                            <tr class="form-group">
                                <td><label>Forward for approval:</label></td>
                                <td>
                                    <select class="selectpicker form-control" id="forward_to_ceo" name="forward_to_ceo" title="Yes Or No">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td><label>Comment or Note:</label></td>
                                <td>
                                    <textarea name="comment" id="comment" cols="30" rows="3" class="form-control"></textarea>
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td><label>Forwarded By:</label></td>
                                <td>
                                    <input type="text" name="generated_by" value="{{ Auth::user()->name }}" readonly="true" class="form-control">
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

    
      <script type="text/javascript">
      	function response(id)
      	{
      		document.getElementById("requestId").value = id
      	}
      </script>
@endsection
