<?php $__env->startSection('title', 'Admin Rights'); ?>

<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center"><b>Grant Admin Rights</b></div>
					<div class="panel-body">
						<form action="/performAdminRights" method="post">
							<?php echo e(csrf_field()); ?>

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
							            	<?php if(count($users) > 0): ?>
	                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                                <?php if($user->name != 'admin'): ?>
	                                                	<option value="<?php echo e($user->employee_id); ?>" data-tokens="<?php echo e($user->name); ?> <?php echo e($user->employee_id); ?> <?php echo e($user->email); ?>">
	                                                		<?php echo e(ucwords($user->name)); ?> / <?php echo e($user->employee_id); ?> / <?php echo e($user->email); ?>

	                                                	</option>
	                                                <?php endif; ?>
	                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                                        <?php endif; ?>
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
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center"><b>Current Admins</b></div>
					<div class="panel-body table-responsive">
						<table class="table table-striped">
							<?php if(count($admins) > 0): ?>
								<tr>
									<th>Sr. No</th>
									<th>Employee Id</th>
									<th>Name</th>
									<th>Email</th>
								</tr>
								<?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($loop->iteration); ?></td>
										<td><?php echo e($admin->employee_id); ?></td>
										<td><?php echo e(ucwords($admin->name)); ?></td>
										<td><?php echo e($admin->email); ?></td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</table>
					</div>
				</div>
			</div>		
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<b>Change Employee Password</b>
					</div>
					<div class="panel-body">
						<form action="/changeEmployeePswd" method="post">
							<?php echo e(csrf_field()); ?>

							<table class="table table-striped">
								<tr class="form-group">
									<td><label>Search Employee Id: </label></td>
									<td>
										<select class="selectpicker form-control" data-live-search="true" title="Name / Employee Id / Email Id" name="employee_id">
							            	<?php if(count($users) > 0): ?>
	                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                                                <?php if($user->name != 'admin'): ?>
	                                                	<option value="<?php echo e($user->employee_id); ?>" data-tokens="<?php echo e($user->name); ?> <?php echo e($user->employee_id); ?> <?php echo e($user->email); ?>">
	                                                		<?php echo e(ucwords($user->name)); ?> / <?php echo e($user->employee_id); ?> / <?php echo e($user->email); ?>

	                                                	</option>
	                                                <?php endif; ?>
	                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                                        <?php endif; ?>
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
				
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>