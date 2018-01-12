@extends('layouts.app')

@section('title', 'Edit profile')

@section('content')

<div class="container-fluid">
	<!--update profile-->
	<div class="row">
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Update profile</b></div>
				<div class="panel-body">
					{!! Form::open(['action' => ['ProfileController@update', auth()->user()->id], 'method' => 'post']) !!}
		                <table class="table table-striped">
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="name">Employee Name</label> </td>	
		                        <td><input type="text" class="form-control" value="{{ucwords(auth()->user()->name)}}" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="id">Employee Id</label></td>
		                        <td><input type="text" class="form-control" value="{{auth()->user()->employee_id}}" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="gender">Gender</label></td>
		                        <td><input type="text" class="form-control" value="{{ ucwords(auth()->user()->gender) }}" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase">{{Form::label('designation', 'Designation')}}</td>
		                        <td> {{Form::text('designation','',['class' => 'form-control'])}}</td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase">{{Form::label('phone_number', 'Phone Number')}}</td>
		                        <td>{{Form::text('phone_number','',['class' => 'form-control'])}}</td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase">{{Form::label('address', 'Address')}}</td>
		                        <td>{{Form::text('address','',['class' => 'form-control'])}}</td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="email">Email Id</label></td>
		                        <td><input type="text" class="form-control" value="{{auth()->user()->email}}" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase">{{Form::label('password', 'Enter Password to make changes')}}</td>
		                        <td>{{Form::password('password', ['class' => 'form-control'])}}</td>
		                    </tr>
		                </table>

	                	{{Form::hidden('_method', 'PUT')}}
	                    <div class="modal-footer">
	                        <button type="reset" class="btn btn-danger">Clear</button>
	                        <button type="submit" class="btn btn-primary color-bg"  name="profile_update_btn">Save changes</button>
	                    </div>
                	{!! Form::close() !!}
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<!--Change profile pic-->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading"><b>Change Profile Picture</b></div>
						<div class="panel-body">
							{!! Form::open(['action' => ['ProfileController@update', auth()->user()->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
								<table class="table table-striped">
									<tr class="form-group">
										<td class="text-uppercase">{{Form::label('profile_pic', 'Upload file')}}</td>
										<td>{{Form::file('profile_pic', ['class' => 'form-control'])}}</td>
									</tr>
									<tr class="form-group">
				                        <td class="text-uppercase">{{Form::label('password', 'Enter Password')}}</td>
				                        <td>{{Form::password('password', ['class' => 'form-control'])}}</td>
									</tr>
								</table>
								{{Form::hidden('_method', 'PUT')}}
			                    <div class="modal-footer">
			                        <button type="reset" class="btn btn-danger">Clear</button>
			                        <button type="submit" class="btn btn-primary color-bg" name="profile_pic_update_btn">Save changes</button>
			                    </div>
		                	{!! Form::close() !!}
		                	<p><b><i>
		                		*Image size should not be greater than 1999kb
		                		<br>
		                		*To remove profile pic just enter password and click on save changes!
		                		</i></b>
		                	</p>
						</div>
					</div>
				</div>
			</div>
			<!--Channge password-->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading"><b>Change Passowrd</b></div>
						<div class="panel-body">
							{!! Form::open(['action' => ['ProfileController@update', auth()->user()->id], 'method' => 'post']) !!}
								<table class="table table-striped">
									<tr class="form-group">
				                        <td class="text-uppercase">{{Form::label('password', 'Enter old Password')}}</td>
				                        <td>{{Form::password('password', ['class' => 'form-control'])}}</td>
									</tr>
									<tr class="form-group">
										<td class="text-uppercase">{{Form::label('newPassword', 'New Password')}}</td>
										<td>{{Form::password('newPassword', ['class' => 'form-control'])}}</td>
									</tr>
								</table>
								{{Form::hidden('_method', 'PUT')}}
			                    <div class="modal-footer">
			                        <button type="reset" class="btn btn-danger">Clear</button>
			                        <button type="submit" class="btn btn-primary color-bg" name="password_change_btn">Change password</button>
			                    </div>
		                	{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection