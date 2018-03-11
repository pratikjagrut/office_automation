<?php $__env->startSection('title', 'New Job Entry'); ?>

<?php $__env->startSection('content'); ?>

<div class="container">
	<div class="row"> 
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<b>New Job Entry</b>
				</div>
				<div class="panel-body">
					<form action="/selectConsumer" method="get">
					    <table class="table table-striped">
					        <tr class="form-group">
					            <td>
					                <select name="consumer_type" class="selectpicker form-control" id="consumer_type" title="Select Consumer Type" required="true">
					                    <option value="partner">Partner</option>
					                    <option value="customer">Customer</option>
					                    <option value="reseller">Reseller</option>
					                </select>
					            </td>
					            <td id="partner">
					                <select class="selectpicker" data-live-search="true" title="Select Partner Name" name="partner_id">
						            	<?php if(count($partners) > 0): ?>
                                            <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($partner->name); ?>" data-tokens="<?php echo e($partner->name); ?>">
                                                	<?php echo e($partner->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
					            	</select>
					            </td>
					            <td id="reseller">
					                <select class="selectpicker" data-live-search="true" title="Select Reseller Name" name="reseller_id">
						            	<?php if(count($resellers) > 0): ?>
                                            <?php $__currentLoopData = $resellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reseller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($reseller->name); ?>" data-tokens="<?php echo e($reseller->name); ?>">
                                                	<?php echo e($reseller->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
					            	</select>
					            </td>
					            <td class="customer">
					                <select class="selectpicker" data-live-search="true" title="Select Circuit id Or Name" name="circuit_id">
						            	<?php if(count($customers) > 0): ?>
                                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($customer->circuit_id != null): ?>
                                                	<option value="<?php echo e($customer->circuit_id); ?>" data-tokens="<?php echo e($customer->circuit_id); ?>">
                                                		<?php echo e($customer->circuit_id); ?>

                                                	</option>
                                                <?php endif; ?>
                                                <?php if($customer->name != null): ?>
                                                	<option value="<?php echo e($customer->name); ?>" data-tokens="<?php echo e($customer->name); ?>">
                                                		<?php echo e($customer->name); ?>

                                                	</option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
					            	</select>
					            </td>
					            <td><input type="submit" class="btn btn-primary form-control" name="submit_name" value="GO"></td>
					        </tr>
					    </table>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<?php if($consumer != null): ?>
						<form action="/submitNewJob" method="post">
							<?php echo e(csrf_field()); ?>

							<table class="table table-striped">
								<?php if($consumer->type == 'customer'): ?>
									<tr class="form-group">
								        <td><label>Circuit Id</label></td>
								        <td>
								            <input type="text" name="circuit_id" value=" <?php echo e(ucwords($consumer->circuit_id)); ?> " class="form-control" required="true" readonly="true">
								        </td>
								    </tr>
								<?php endif; ?>
								<tr class="form-group">
							        <td><label>Name</label></td>
							        <td>
							            <input type="text" name="name" value=" <?php echo e(ucwords($consumer->name)); ?> " class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Address</label></td>
							        <td>
							            <textarea type="text" name="address" class="form-control" required="true" readonly="true"><?php echo e(ucwords($consumer->address)); ?>

							            </textarea>
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Area</label></td>
							        <td>
							            <input type="text" name="area" value="<?php echo e(ucwords($consumer->area)); ?>" class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>City</label></td>
							        <td>
							            <input type="text" name="city" value="<?php echo e(ucwords($consumer->city)); ?>" class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>State</label></td>
							        <td>
							            <input type="text" name="state" value="<?php echo e(ucwords($consumer->state)); ?>" class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Contact Details</label></td>
							        <td>
							            <input type="text" name="contact_details" class="form-control" value="<?php echo e($consumer->contact_details); ?>" required="true">
							        </td>
							    </tr>
	                            <tr class="form-group">
	                                <td><label>Case Reason</label></td>
	                                <td>
	                                    <input type="text" name="case_reason" class="form-control" required="true">
	                                </td>
	                            </tr>
	                            <tr class="form-group">
						            <td>
						                <select name="assign_job" class="selectpicker form-control" id="assign_job" title="Assign Job To">
						                    <option value="engineer">Engineer</option>
						                    <option value="team">Team</option>
						                </select>
						            </td>
						            <td id="engineer">
						            	<select class="selectpicker" data-live-search="true" title="Select Engineer" name="assign_to_engineer">
							            	<?php if($engineers != null): ?>
                                                <?php $__currentLoopData = $engineers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $engineer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($engineer->name != 'admin'): ?>
                                                    	<option value="<?php echo e($engineer->name); ?>" data-tokens="<?php echo e($engineer->name); ?>">
                                                    		<?php echo e(ucwords($engineer->name)); ?>

                                                    	</option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
						            	</select>
						            </td>
						            <td id="team">
						            	<select class="selectpicker" data-live-search="true" title="Select Team" name="assign_to_team">
							            	<?php if($teams != null): ?>
                                                <?php $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($team->department); ?>" data-tokens="<?php echo e($team->department); ?>">
                                                    	<?php echo e(ucwords($team->department)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
						            	</select>
						            </td>
						        </tr>
						        <tr class="form-group">
						            <td><label>Generated By</label></td>
						            <td>
						                <input type="text" name="generated_by" value="<?php echo e(ucwords(auth()->user()->name)); ?>" class="form-control" required="true" readonly="true">
						            </td>
						        </tr>
	                            <input type="text" name="get_consumer_type" hidden="true" value="<?php echo e($consumer->type); ?>">

	                            <input type="text" name="generation_date" id="generation_date" readonly="true" hidden="true">

	                            <input type="text" name="assigned_to_level" id="asssigned_to_level" value="2" readonly="true" hidden="true">
	                            
	                            <script type="text/javascript">
	                            	$(document).ready(function() {
	                            		var timestamps = new Date()
	                            		document.getElementById("generation_date").value = timestamps.getTime()	
	                            	});
	                            </script>
						        <tr class="form-group">
						            <td><label></label></td>
						            <td>
						                <input type="submit" name="submit_query" class="form-control btn btn-success" required="true">
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

<script type="text/javascript">
	$(document).ready(function(){
		$("#engineer").hide()
		$("#team").hide()


		$("#assign_job").change(function(){
			var assign_job = $(this).val()
			if(assign_job == "engineer")
			{
				$("#engineer").show()
				$("#team").hide()
			}
			else
			{
				$("#engineer").hide()
				$("#team").show()
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#partner").hide()
		$(".customer").hide()
		$("#reseller").hide()

		$("#consumer_type").change(function(){
			var consumer_type = $(this).val()
			if(consumer_type == "partner")
			{
				$("#partner").show()
				$(".customer").hide()
				$("#reseller").hide()
			}
			if(consumer_type == "customer")
			{
				$("#partner").hide()
				$(".customer").show()
				$("#reseller").hide()
			}
			if(consumer_type == "reseller")
			{
				$("#partner").hide()
				$(".customer").hide()
				$("#reseller").show()
			}
		})
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>