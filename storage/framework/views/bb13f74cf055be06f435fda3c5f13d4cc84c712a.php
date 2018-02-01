<?php $__env->startSection('title', 'Add New Consumer'); ?>

<?php $__env->startSection('content'); ?>

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
					<table class="table table-striped table-bordered" style="border: 1px solid #ccc;">
						<?php if($consumers != null && count($consumers) > 0 ): ?>
							<tr>
								<th>Sr. No</th>
								<th>Circuit Id</th>
								<th>Name</th>
								<th>Address</th>
								<th>Area</th>
								<th>City</th>
								<th>State</th>
								<th>Contact Details</th>
							</tr>
							<?php $__currentLoopData = $consumers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consumer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><?php echo e($loop->iteration); ?></td>
									<td><?php echo e($consumer->circuit_id); ?></td>
									<td><?php echo e(ucwords($consumer->name)); ?></td>
									<td><?php echo e(ucwords($consumer->address)); ?></td>
									<td><?php echo e(ucwords($consumer->area)); ?></td>
									<td><?php echo e(ucwords($consumer->city)); ?></td>
									<td><?php echo e(ucwords($consumer->state)); ?></td>
									<td><?php echo e($consumer->contact_details); ?></td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>
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
					<?php if($consumer_type != null): ?>
						<form action="/registerNewConsumer" method="post">
							<?php echo e(csrf_field()); ?>

							<table class="table table-striped">
								<tr class="form-group">
							        <td><label>Consumer Type</label></td>
							        <td>
							            <input type="text" name="consumer_type" class="form-control" readonly="true" value="<?php echo e(ucwords($consumer_type)); ?>">
							        </td>
							    </tr>
								<?php if($consumer_type == 'customer'): ?>
									<tr class="form-group">
								        <td><label>Circuit Id</label></td>
								        <td>
								            <input type="text" id="circuit_id" name="circuit_id" class="form-control" required="true" >
								        </td>
								    </tr>
								<?php endif; ?>
								<tr class="form-group">
							        <td><label>Name</label></td>
							        <td>
							            <input type="text" name="name" class="form-control" required="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Address</label></td>
							        <td>
							            <input type="text" name="address" class="form-control" required="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Area</label></td>
							        <td>
							            <input type="text" name="area" class="form-control" required="true">
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
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>