<?php $__env->startSection('title', 'Export Finished Jobs'); ?>

<?php $__env->startSection('content'); ?>
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
               <div class="panel-heading text-center" >Extension</div>

                <div class="panel-body">
                    <div class="modal-body">
                     <form action="/closeJob">
                      <table class="table table-striped">
                        <tr class="from-group">
                            <td><label>Customer User_ID: </label></td>
                            <td>
                                <input id="user_id" type="text" class="form-control" name="user_id" value="" required>
                            </td>
                        </tr>
                        
                        <tr class="from-group">
                            <td><label>Customer Name: </label></td>
                            <td><input id="name" type="text" class="form-control" name="name" value="" required pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Complaint Date: </label></td>
                            <td>
                                <input id="complaint_date" type="text" class="form-control" name="complaint_date" required>
                            </td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Expiry: </label></td>
                            <td><input id="expiry" type="date" class="form-control" name="expiry" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Status: </label></td>
                            <td> <input id="status" type="text" class="form-control" name="status" required pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Reason: </label></td>
                            <td><input id="reason" type="text" class="form-control" name="reason" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Assigned to: </label></td>
                            <td><input id="assigned" type="text" class="form-control" name="assigned" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Generated by: </label></td>
                            <td><input id="generated_by" type="text" class="form-control" name="generated_by" required></td>
                        </tr>


                        <tr class="from-group">
                            <td></td>
                            <td>
                                <button type="clear" name="clear" class="btn btn-danger">Clear!</button>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </td>
                        </tr>
                     </table>
                    </form>
                  </div>
                </div>
            </div>            
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>