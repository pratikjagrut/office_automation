@extends('layouts.app')

@section('title', 'Admin Rights')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center"><b>Grant Admin Rights</b></div>
					<div class="panel-body">
						<form action="/performAdminRights" method="post">
							{{csrf_field()}}
							<table class="table table-striped">
								<tr class="form-group">
									<td><label>Select Action: </label></td>
									<td>
										<select name="action" class="selectpicker form-control" required="true" title="Select Action">
											<option value="assignAdminRights">
												Assign Admin Rights
											</option>
											<option value="removeAdminRights">
												Remove Admin Rights
											</option>
											<option value="deleteAccount">
												Delete user
											</option>
										</select>
									</td>
								</tr>
								<tr class="form-group">
									<td><label>Enter Employee Id: </label></td>
									<td>
										<select class="selectpicker form-control" data-live-search="true" title="Name / Employee Id / Email Id" name="employee_id">
							            	@if (count($users) > 0)
	                                            @foreach ($users as $user)
	                                                @if ($user->name != 'admin')
	                                                	<option value="{{$user->employee_id}}" data-tokens="{{$user->name}} {{$user->employee_id}} {{$user->email}}">
	                                                		{{ucwords($user->name)}} / {{$user->employee_id}} / {{$user->email}}
	                                                	</option>
	                                                @endif
	                                            @endforeach
	                                        @endif
						            	</select>
									</td>
								</tr>
								<tr class="form-group">
									<td><label>Enter Password: </label></td>
									<td>
										<input type="password" class="form-control" name="password" required="true">
									</td>
								</tr>
								<tr class="form-group">
									<td></td>
									<td>
										<input type="submit" class="btn btn-primary pull-right" value="Submit" name="submit">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<b>Change Employee Password</b>
					</div>
					<div class="panel-body">
						<form action="/changeEmployeePswd" method="post">
							{{csrf_field()}}
							<table class="table table-striped">
								<tr class="form-group">
									<td><label>Search Employee Id: </label></td>
									<td>
										<select class="selectpicker form-control" data-live-search="true" title="Name / Employee Id / Email Id" name="employee_id">
							            	@if (count($users) > 0)
	                                            @foreach ($users as $user)
	                                                @if ($user->name != 'admin')
	                                                	<option value="{{$user->employee_id}}" data-tokens="{{$user->name}} {{$user->employee_id}} {{$user->email}}">
	                                                		{{ucwords($user->name)}} / {{$user->employee_id}} / {{$user->email}}
	                                                	</option>
	                                                @endif
	                                            @endforeach
	                                        @endif
						            	</select>
									</td>
								</tr>
								<tr class="form-group">
									<td><label>Enter New Password: </label></td>
									<td>
										<input type="password" class="form-control" name="new_password" required="true">
									</td>
								</tr>
								<tr class="form-group">
									<td></td>
									<td>
										<input type="submit" class="btn btn-primary pull-right" value="Submit" name="submit">
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center"><b>Current Admins</b></div>
					<div class="panel-body table-responsive">
						<table class="table table-striped">
							@if (count($admins) > 0)
								<tr>
									<th>Sr. No</th>
									<th>Employee Id</th>
									<th>Name</th>
									<th>Email</th>
								</tr>
								@foreach ($admins as $admin)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$admin->employee_id}}</td>
										<td>{{ucwords($admin->name)}}</td>
										<td>{{$admin->email}}</td>
									</tr>
								@endforeach
							@endif
						</table>
					</div>
				</div>
			</div>		
		</div>
		<div class="row">
			<div class="col-md-6">
				
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
	</div>

@endsection