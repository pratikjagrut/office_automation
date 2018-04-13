<?php $__env->startSection('title', 'Profile'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>
                            <b>Profile Image</b>
                        </h3>
                    </div>
                    <div class="panel-body text-center">
                        <img src="/storage/profile_pics/<?php echo e($profile->profile_pic); ?>" class="img-thumbnail" id="profile_pic">
                        <div class="well col-md-4 col-md-offset-4 text-center">
                            <h4>
                                <b><?php echo e(ucwords(auth()->user()->user_type)); ?></b>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>
                            <b>General Information</b>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Name</td>
                                <td><?php echo e(ucwords(auth()->user()->name)); ?></td>
                            </tr>
                            <tr>
                                <td>Employee Id</td>
                                <td><?php echo e(auth()->user()->employee_id); ?></td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td><?php echo e(ucwords($profile->designation)); ?></td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td><?php echo e(ucwords(auth()->user()->gender)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>
                            <b>Contact Details</b>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Email</td>
                                <td><?php echo e(auth()->user()->email); ?></td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td><?php echo e($profile->phone_number); ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td><?php echo e(ucfirst($profile->address)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>