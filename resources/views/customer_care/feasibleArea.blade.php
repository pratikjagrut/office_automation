@extends('layouts.app')

@section('title', 'Export Finished Jobs')

@section('content')
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Feasible Areas</div>

                    <div class="panel-body">
                        <div class="modal-body">
                            <form action="/closeJob">
                                <table class="table table-striped">
                                    <tr class="from-group">
                                      <td><label>Reseller Name: </label></td>
                                      <td><input type="text" name="reseller_name" id="reseller_name" class="form-control" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                        
                                    <tr class="from-group">
                                       <td><label>Building: </label></td>
                                       <td><input id="building" type="text" class="form-control" name="building"  required></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Society: </label></td>
                                       <td><input id="society" type="text" class="form-control" name="society" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                        <td><label>Area: </label></td>
                                        <td><input id="area" type="text" class="form-control" name="area" required></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>City: </label></td>
                                       <td><input id="city" type="text" class="form-control" name="city" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Switch Location: </label></td>
                                      <td><input id="switch_location" type="text" class="form-control" name="switch_location" required></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Contact Person Name: </label></td>
                                       <td><input id="contact_name" type="text" class="form-control" name="contact_name" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Contact Person Number: </label></td>
                                       <td><input id="contact_number" type="tel" class="form-control" name="contact_number" required pattern="^\d{10}$" title="Enter 10-digits only!"></td>
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




@endsection
