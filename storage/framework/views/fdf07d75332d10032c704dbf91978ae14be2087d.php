<?php $__env->startSection('title', 'Edit profile'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
	<!--update profile-->
	<div class="row">
		<div class="col-md-7">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Update profile</b></div>
				<div class="panel-body">
					<?php echo Form::open(['action' => ['ProfileController@update', auth()->user()->id], 'method' => 'post']); ?>

		                <table class="table table-striped">
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="name">Employee Name</label> </td>	
		                        <td><input type="text" class="form-control" value="<?php echo e(ucwords(auth()->user()->name)); ?>" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="id">Employee Id</label></td>
		                        <td><input type="text" class="form-control" value="<?php echo e(auth()->user()->employee_id); ?>" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="gender">Gender</label></td>
		                        <td><input type="text" class="form-control" value="<?php echo e(ucwords(auth()->user()->gender)); ?>" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><?php echo e(Form::label('designation', 'Designation')); ?></td>
		                        <td> <?php echo e(Form::text('designation','',['class' => 'form-control'])); ?></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><?php echo e(Form::label('phone_number', 'Phone Number')); ?></td>
		                        <td><?php echo e(Form::text('phone_number','',['class' => 'form-control'])); ?></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><?php echo e(Form::label('address', 'Address')); ?></td>
		                        <td><?php echo e(Form::text('address','',['class' => 'form-control'])); ?></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><label for="email">Email Id</label></td>
		                        <td><input type="text" class="form-control" value="<?php echo e(auth()->user()->email); ?>" readonly="true"></td>
		                    </tr>
		                    <tr class="form-group">
		                        <td class="text-uppercase"><?php echo e(Form::label('password', 'Enter Password to make changes')); ?></td>
		                        <td><?php echo e(Form::password('password', ['class' => 'form-control'])); ?></td>
		                    </tr>
		                </table>

	                	<?php echo e(Form::hidden('_method', 'PUT')); ?>

	                    <div class="modal-footer">
	                        <button type="reset" class="btn btn-danger">Clear</button>
	                        <button type="submit" class="btn btn-primary color-bg"  name="profile_update_btn">Save changes</button>
	                    </div>
                	<?php echo Form::close(); ?>

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
							<?php echo Form::open(['action' => ['ProfileController@update', auth()->user()->id], 'method' => 'post', 'enctype' => 'multipart/form-data']); ?>

								<table class="table table-striped">
									<tr class="form-group">
										<td class="text-uppercase"><?php echo e(Form::label('profile_pic', 'Upload file')); ?></td>
										<td><?php echo e(Form::file('profile_pic', ['class' => 'form-control'])); ?></td>
									</tr>
									<tr class="form-group">
				                        <td class="text-uppercase"><?php echo e(Form::label('password', 'Enter Password')); ?></td>
				                        <td><?php echo e(Form::password('password', ['class' => 'form-control'])); ?></td>
									</tr>
								</table>
								<?php echo e(Form::hidden('_method', 'PUT')); ?>

			                    <div class="modal-footer">
			                        <button type="reset" class="btn btn-danger">Clear</button>
			                        <button type="submit" class="btn btn-primary color-bg" name="profile_pic_update_btn">Save changes</button>
			                    </div>
		                	<?php echo Form::close(); ?>

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
							<?php echo Form::open(['action' => ['ProfileController@update', auth()->user()->id], 'method' => 'post']); ?>

								<table class="table table-striped">
									<tr class="form-group">
				                        <td class="text-uppercase"><?php echo e(Form::label('password', 'Enter old Password')); ?></td>
				                        <td><?php echo e(Form::password('password', ['class' => 'form-control'])); ?></td>
									</tr>
									<tr class="form-group">
										<td class="text-uppercase"><?php echo e(Form::label('newPassword', 'New Password')); ?></td>
										<td><?php echo e(Form::password('newPassword', ['class' => 'form-control'])); ?></td>
									</tr>
								</table>
								<?php echo e(Form::hidden('_method', 'PUT')); ?>

			                    <div class="modal-footer">
			                        <button type="reset" class="btn btn-danger">Clear</button>
			                        <button type="submit" class="btn btn-primary color-bg" name="password_change_btn">Change password</button>
			                    </div>
		                	<?php echo Form::close(); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>