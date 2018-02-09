@extends('layouts.app')

@section('title', 'Purchase Request Form')

@section('content')
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Purchase Request form</div>

                    <div class="panel-body">
                        <div class="modal-body">
                            <form action="/closeJob">
                                <table class="table table-striped">
                                    
                                    <tr class="from-group">
                                      <td><label>Vendor Name: </label></td>
                                      <td><input type="text" name="vendor_name" id="vendor_name" class="form-control" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                        
                                    <tr class="from-group">
                                       <td><label>Vendor Address: </label></td>
                                       <td><input id="customer_address" type="text" class="form-control" name="customer_address"  required pattern="([A-Za-z0-9\s]){1,}" title="Special Characters not allowed."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Email ID: </label></td>
                                      <td><input id="email_id" type="email" class="form-control" name="email_id" required></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Date: </label></td>
                                       <td><input id="date" type="date" class="form-control" name="date" required></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>P.O.Number: </label></td>
                                      <td><input id="po_number" type="number" min="1" class="form-control" name="po_number" required ></td>
                                    </tr>
                                    
                                    <tr class="from-group">
                                      <td><label>From Department: </label></td>
                                      <td><input id="from_department" type="text" class="form-control" name="from_department" required pattern="([A-Za-z\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Purchase Requisition Number: </label></td>
                                      <td><input id="purchase_requistion" type="number" min="1" class="form-control" name="purchase_requistion" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Quotation Department: </label></td>
                                      <td><input id="quotation_department" type="text" class="form-control" name="quotation_department" required pattern="([A-Za-z\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Ship to: </label></td>
                                      <td><input id="ship_to" type="text" class="form-control" name="ship_to" required pattern="([A-Za-z0-9\s]){1,}" title="Special Characters not allowed."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Good Description: </label></td>
                                      <td><input id="good_description" type="text" class="form-control" name="good_description" required pattern="([A-Za-z\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Unit: </label></td>
                                      <td><input id="unit" type="number" min="1" class="form-control" name="unit" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Quantity: </label></td>
                                      <td><input id="quantity" type="number" min="1" class="form-control" name="quantity" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Unit Price: </label></td>
                                      <td><input id="unit_price" type="number" min="1" class="form-control" name="unit_price" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Amount: </label></td>
                                      <td><input id="amount" type="number" min="1" class="form-control" name="amount" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Total Rs: </label></td>
                                      <td><input id="total_rs" type="number" min="1" class="form-control" name="total_rs" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Payment terms: </label></td>
                                      <td><input id="payment_terms" type="text" class="form-control" name="payment_terms" required pattern="([A-Za-z0-9\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Validity of P.O: </label></td>
                                      <td><input id="validity_po" type="text" class="form-control" name="validity_po" required pattern="([A-Za-z0-9\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Date of Expiry: </label></td>
                                       <td><input id="date_expiry" type="date" class="form-control" name="date_expiry" required></td>
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
