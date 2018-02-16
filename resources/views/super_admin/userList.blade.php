@extends('layouts.app')

@section('title', 'Admin Rights')

@section('content')

<div class="container">
	<div class="row">
			 	<div class="col-md-12">
			 		<div class="well text-center">
			 			<form action="/searchUser" method="post" class="form-inline">
			 				{{csrf_field()}}
			 				<select name="user_type" class="form-control" required="true">
			 				      <option value="">Select User</option>
			 				      <option value="all">All Users</option>
			 				      <option value="admin">Admin</option>
			 				      <option value="user">User</option>
			 				</select>
			 				<button type="submit" name="searchUser" class="btn btn-success">List</button>
			 			</form>
			 		</div>
			 	</div>
			 </div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><b>User List</b></div>
				<div class="panel-body table-responsive">
					@if (count($users) > 0)
						<table class="table table-striped" style="border: 1px solid #ddd;">
							<tr>
								<th>Sr. No</th>
								<th>Employee Id</th>
								<th>Name</th>
								<th>Email Id</th>
								<th>Account</th>
								<th>Created At</th>
								<th>Delete</th>
								<th>Assign Rights</th>
							</tr>
							@foreach ($users as $user)
								<tr>
									<td>{{$loop->iteration}}</td>
									<td>{{$user->employee_id}}</td>
									<td>{{ucwords($user->name)}}</td>
									<td>{{$user->email}}</td>
									<td>{{ucwords($user->user_type)}}</td>
									<td>{{$user->created_at}}</td>
									<td><button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser" id="{{$user->employee_id}}" onclick="deleteUser(this.id)">Delete</button></td>
									<td><button class="btn btn-info" data-toggle="modal" data-target="#performAction" id="{{$user->employee_id}}" onclick="performAction(this.id)">Assign rights</button></td>
								</tr>
							@endforeach
						</table>
					@endif
				</div>
			</div>
			<div class="text-center">{{$users->links()}}</div>
		</div>
	</div>
</div>

<!-- delete User Modal -->
<div id="deleteUser" class="modal fade" role="dialog">
   	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Confrim Delete User</h4>
	      	</div>
	      	<div class="modal-body">
	        	<form action="/deleteUser" method="post">
	        		{{csrf_field()}}
	        		<table class="table table-striped">
	        			<tr class="form-group">
	        				<td><label>Employee Id</label></td>
	        				<td><input type="text" name="employee_id" class="form-control" required="true" id="employee_id" readonly="true"></td>
	        			</tr>
	        			<tr class="form-group">
	        				<td><label>Admin Password</label></td>
	        				<td><input type="password" name="password" class="form-control" required="true"></td>
	        			</tr>
	        			<tr class="form-group">
	        				<td></td>
	        				<td><input type="submit" class="btn btn-danger" value="Submit"></td>
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


<!-- Perform action Modal -->
<div id="performAction" class="modal fade" role="dialog">
   	<div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Perform Action</h4>
	      	</div>
	      	<div class="modal-body">
	        	<form action="/performAction" method="post">
	        		{{csrf_field()}}
	        		<table class="table table-striped">
	        			<tr class="form-group">
	        				<td><label>Select Action</label></td>
	        				<td>
	        					<select name="action" class="form-control" required="true">
	        					      <option value="">Select Action</option>
	        					      <option value="makeAdmin">Make Admin</option>
	        					      <option value="removeAdmin">Remove Admin</option>
	        					</select>
	        				</td>
	        			</tr>
	        			<tr class="form-group">
	        				<td><label>Employee Id</label></td>
	        				<td><input type="text" name="employee_id" class="form-control" required="true" id="employee_id_p" readonly="true"></td>
	        			</tr>
	        			<tr class="form-group">
	        				<td><label>Admin Password</label></td>
	        				<td><input type="password" name="password" class="form-control" required="true"></td>
	        			</tr>
	        			<tr class="form-group">
	        				<td></td>
	        				<td><input type="submit" class="btn btn-success" value="Submit"></td>
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
	function deleteUser(clicked_id)
	{
	  	document.getElementById("employee_id").value = clicked_id
	}

	function performAction(clicked_id)
	{
	  	document.getElementById("employee_id_p").value = clicked_id
	}
</script>
@endsection