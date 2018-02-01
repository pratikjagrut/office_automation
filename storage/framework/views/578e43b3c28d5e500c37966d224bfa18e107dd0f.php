<?php $__env->startSection('title', 'P2P Connectivity Form'); ?>

<?php $__env->startSection('content'); ?>
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">P2P Connectivity</div>

                    <div class="panel-body">
                        <div class="modal-body">
                            <form action="/closeJob">
                                <table class="table table-striped">
                                    <tr class="from-group">
                                      <td><label>Product Name: </label></td>
                                      <td><input type="text" name="product_name" id="product_name" class="form-control" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Customer Name: </label></td>
                                       <td><input id="customer_name" type="text" class="form-control" name="name" value="" required pattern="([A-Za-z\s]){3,}" title="Only letters are allowed. Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Contact Person Name: </label></td>
                                       <td><input id="contact_person" type="text" class="form-control" name="contact_person" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Contact Person Number: </label></td>
                                       <td><input id="contact_number" type="tel" class="form-control" name="contact_number" required pattern="^\d{10}$" title="Enter 10-digits only!"></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Contact Person Email: </label></td>
                                      <td><input id="person_email" type="email" class="form-control" name="person_email" required></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>A end Address: </label></td>
                                       <td><input id="a_end_address" type="text" class="form-control" name="a_end_address"  required></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>A end City: </label></td>
                                       <td><input id="a_end_city" type="text" class="form-control" name="a_end_city" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>A end State: </label></td>
                                      <td><input id="a_end_state" type="text" class="form-control" name="a_end_state" required></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>A end Pincode: </label></td>
                                      <td><input id="a_end_pincode" type="tel" class="form-control" name="a_end_pincode" required pattern="^\d{6}$" title="Pincode should be of 6 digits" ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>A end lat/long: </label></td>
                                      <td><input id="a_end_lat" type="number" class="form-control" name="a_end_lat" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>B end Address: </label></td>
                                       <td><input id="b_end_address" type="text" class="form-control" name="a_end_address"  required></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>B end City: </label></td>
                                       <td><input id="b_end_city" type="text" class="form-control" name="b_end_city" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>B end State: </label></td>
                                      <td><input id="b_end_state" type="text" class="form-control" name="a_end_state" required></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>B end Pincode: </label></td>
                                      <td><input id="b_end_pincode" type="tel" class="form-control" name="b_end_pincode" required pattern="^\d{6}$" title="Pincode should be of 6 digits" ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>B end lat/long: </label></td>
                                      <td><input id="b_end_lat" type="number" class="form-control" name="b_end_lat" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Network Priority: </label></td>
                                      <td><input id="network_priority" type="number" class="form-control" name="network_priority" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Feasibility Status: </label></td>
                                      <td><input id="feasiblity_status" type="text" class="form-control" name="feasiblity_status" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>A-end feasibility: </label></td>
                                      <td><input id="a_end_feasibility" type="text" class="form-control" name="a_end_feasibility" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>B-end feasibility: </label></td>
                                      <td><input id="b_end_feasibility" type="text" class="form-control" name="b_end_feasibility" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>BTS Address: </label></td>
                                      <td><input id="bts_address" type="text" class="form-control" name="bts_address" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Generated by: </label></td>
                                      <td><input id="generated_by" type="text" class="form-control" name="generate" required></td>
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