@extends('layouts.app')

@section('title', 'List Refunds')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7">
				<div class="well">
					<form action="/listRefunds" method="get">	
						<table class="table-condensed">
							<tr class="form-group">
								<td>
									<select class="form-control selectpicker" name="customer_id" id="customer_id1" data-live-search="true" title="Customer Id">
									    @if (count($customer_id) > 0)
									        @foreach ($customer_id as $customer)
									            <option data-tokens="{{$customer->customer_id}}" value="{{$customer->customer_id}}">{{$customer->customer_id}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="customer_name" id="customer_name1" data-live-search="true" title="Customer Name">
									    @if (count($customer_name) > 0)
									        @foreach ($customer_name as $customer1)
									            <option data-tokens="{{$customer1->customer_name}}" value="{{$customer1->customer_name}}">{{$customer1->customer_name}}</option>
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
									<select class="form-control selectpicker" name="status" id="status" title="Status">
									    <option value="granted">Granted</option>
									    <option value="rejected">Rejected</option>
									    <option value="pending">Pending</option>  
									</select>
								</td>
								<td>
									<input placeholder="Refund Requested Date" class="form-control" type="text" onfocus="(this.type='date')" name="generated_date" onblur="(this.type='text')">
								</td>
								<td>
									<button type="submit" name="filter" class="btn btn-success">Search</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-2">
				<div class="well text-center">
					<a href="/exportRefunds" class="btn btn-warning">Export</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if (count($refunds) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center"><b>Refunds</b></div>
						<div class="panel-body table-responsive">
							<form action="/actOnRefunds" method="post">
								{{csrf_field()}}
								<table class="table table-striped table-bordered" style="border: 1px solid #ccc;">
									<tr>
										<th>Sr. No</th>
										<th>Customer Id</th>
										<th>Customer Name</th>
										<th>Bank Name</th>
										<th>Account Number</th>
										<th>Bank Branch</th>
										<th>IFSC Code</th>
										<th>Amount</th>
										<th>Reason</th>
										<th>Mail Date</th>
										<th>Assigned To</th>
										<th>Generated By</th>
										<th>Generated Date</th>
										<th>Status</th>
										<th>Acted By</th>
										<th>Grant</th>
										<th>Reject</th>
										<th>Delete</th>
									</tr>
									@foreach ($refunds as $refund)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{ucwords($refund->customer_id)}}</td>
											<td>{{ucwords($refund->customer_name)}}</td>
											<td>{{ucwords($refund->bank)}}</td>
											<td>{{ucwords($refund->account_no)}}</td>
											<td>{{ucwords($refund->branch)}}</td>
											<td>{{ucwords($refund->ifsc_no)}}</td>
											<td>{{ucwords($refund->refund_amount)}}</td>
											<td>{{ucwords($refund->reason)}}</td>
											<td>{{ucwords($refund->mail_date)}}</td>
											<td>{{ucwords($refund->assigned_to)}}</td>
											<td>{{ucwords($refund->generated_by)}}</td>
											<td>{{$refund->created_at}}</td>
											<td>{{ucwords($refund->refund_status)}}</td>
											<td>{{ucwords($refund->granted_by)}}</td>
											<td>
												<input type="checkbox" name="grantRefund[]" value="{{$refund->id}}">
											</td>
											<td>
												<input type="checkbox" name="rejectRefund[]" value="{{$refund->id}}">
											</td>
											<td>
												<input type="checkbox" name="deleteRefund[]" value="{{$refund->id}}">
											</td>
										</tr>
									@endforeach	
								</table>
								<input type="hidden" name="granted_by" value="{{auth()->user()->name}}">
								<input type="submit" class="btn btn-danger pull-right" name="action" value="Submit">
							</form>	
						</div>
					</div>
					@else
					<h1 class="text-center">NO DATA FOUND</h1>
				@endif
				<div class="text-center">{{$refunds->links()}}</div>
			</div>
		</div>
	</div>
@endsection