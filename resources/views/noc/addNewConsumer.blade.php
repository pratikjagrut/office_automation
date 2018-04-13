@extends('layouts.app')

@section('title', 'Add New Consumer')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<b>Consumer List</b>
				</div>
				<div class="panel-body table-responsive">
					<form action="/listConsumer" method="get">
					    <table class="table table-striped">
					        <tr class="form-group">
					            <td>
					                <select name="consumer_type" class="form-control" required="true">
					                	<option value="">Select Consumer Type</option>
					                    <option value="partner">Partner</option>
					                    <option value="customer">Customer</option>
					                    <option value="reseller">Reseller</option>
					                </select>
					            </td>
					            <td><input type="submit" class="btn btn-primary form-control" name="submit_name" value="GO"></td>
					        </tr>
					    </table>
					</form>
					<table class="table table-striped table-bordered" style="border: 1px solid #ccc;">
						@if ($consumers != null && count($consumers) > 0 )
							<tr>
								<th>Sr. No</th>
								@if ($consumer_type1 == 'customer')
									<th>Circuit Id</th>
								@endif
								<th>Name</th>
								<th>Address</th>
								<th>Area</th>
								<th>City</th>
								<th>State</th>
								<th>Contact Details</th>
							</tr>
							@foreach ($consumers as $consumer)
								<tr>
									<td>{{$loop->iteration}}</td>
									@if ($consumer_type1 == 'customer')
										<td>{{$consumer->circuit_id}}</td>
									@endif
									<td>{{ucwords($consumer->name)}}</td>
									<td>{{ucwords($consumer->address)}}</td>
									<td>{{ucwords($consumer->area)}}</td>
									<td>{{ucwords($consumer->city)}}</td>
									<td>{{ucwords($consumer->state)}}</td>
									<td>{{$consumer->contact_details}}</td>
								</tr>
							@endforeach
							<div class="text-center">{{$consumers->links()}}</div>
						@endif
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<b>Register New Consumer</b>
				</div>
				<div class="panel-body">
					<form action="/setConsumer" method="get">
					    <table class="table table-striped">
					        <tr class="form-group">
					            <td>
					                <select name="consumer_type" class="form-control" required="true">
					                    <option value="">Select Consumer</option>
					                    <option value="partner">Partner</option>
					                    <option value="customer">Customer</option>
					                    <option value="reseller">Reseller</option>
					                </select>
					            </td>
					            <td><input type="submit" class="btn btn-primary form-control" name="submit_name" value="GO"></td>
					        </tr>
					    </table>
					</form>
					@if ($consumer_type != null)
						<form action="/registerNewConsumer" method="post">
							{{ csrf_field() }}
							<table class="table table-striped">
								<tr class="form-group">
							        <td><label>Consumer Type</label></td>
							        <td>
							            <input type="text" name="consumer_type" class="form-control" readonly="true" value="{{ucwords($consumer_type)}}">
							        </td>
							    </tr>
								@if ($consumer_type == 'customer')
									<tr class="form-group">
								        <td><label>Circuit Id</label></td>
								        <td>
								            <input type="text" id="circuit_id" name="circuit_id" class="form-control" required="true" >
								        </td>
								    </tr>
								@endif
								<tr class="form-group">
							        <td><label>Name</label></td>
							        <td>
							            <input type="text" name="name" class="form-control" required="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Address</label></td>
							        <td>
							            <input type="text" name="address" class="form-control">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Area</label></td>
							        <td>
							            <input type="text" name="area" class="form-control">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>City</label></td>
							        <td>
							            <input type="text" name="city" class="form-control" required="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>State</label></td>
							        <td>
							            <input type="text" name="state" class="form-control" required="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Contact Details</label></td>
							        <td>
							            <input type="text" name="contact_details" class="form-control">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label></label></td>
							        <td>
							            <input type="submit" name="register" class="form-control btn btn-success" >
							        </td>
							    </tr>   
							</table>
						</form>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection