<?php if(count($errors) > 0): ?>
	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="alert alert-danger text-center">
			<?php echo e($error); ?>

		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php if(session('success')): ?>
	<div class="alert alert-success text-center">
		<h3>
			<b><?php echo e(session('success')); ?></b>
		</h3>
	</div>
<?php endif; ?>

<?php if(session('error')): ?>
	<div class="alert alert-danger text-center">
		<h3>
			<b><?php echo e(session('error')); ?></b>
		</h3>
	</div>
<?php endif; ?>

<?php if(session('delete')): ?>
	<div class="alert alert-warning text-center">
		<h3>
			<b><?php echo e(session('delete')); ?></b>
		</h3>
	</div>
<?php endif; ?>

<?php if(session('ticket')): ?>
	<div class="alert alert-warning text-center">
		<h3>
			Ticket number is: <b><?php echo e(session('ticket')); ?></b>
		</h3>
	</div>
<?php endif; ?>