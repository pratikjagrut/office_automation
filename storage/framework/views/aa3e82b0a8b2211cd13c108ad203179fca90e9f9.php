<?php $__env->startSection('title', 'Add New User'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="employee_id" class="col-md-4 control-label">Employee Id</label>

                            <div class="col-md-6">
                                <input id="employee_id" type="text" class="form-control" name="employee_id" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="department" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                <select id="department" type="text" class="selectpicker  form-control" name="department" title="Select Department" required>
                                    <option value="accounts">Accounts</option>
                                    <option value="cc">Customer Care</option>
                                    <option value="hr">Human Resource</option>
                                    <option value="inventory">Inventory</option>
                                    <option value="networking">Networking</option>
                                    <option value="noc">NOC</option>
                                    <option value="Sales">sales</option>
                                    <option value="voip">VOIP</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="user_type" class="col-md-4 control-label">User type</label>

                            <div class="col-md-3">
                                <input id="user_type" type="radio" name="user_type" value="user" checked required> User
                            </div>

                            <div class="col-md-3">
                                <input id="user_type" type="radio" name="user_type" value="admin" required> Admin
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <select name="gender" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>