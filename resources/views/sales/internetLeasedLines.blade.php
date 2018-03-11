@extends('layouts.app')

@section('title', 'ILL Form')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                      <b>Internet Leased Line Form</b>
                    </div>
                    <div class="panel-body table-responsive">
                        <form action="/internetLeasedLines" method="post">
                            {{csrf_field()}}
                            <table class="table table-striped">
                                <tr class="form-group">
                                   <td><label>Customer Name: </label></td>
                                   <td><input type="text" name="customer_name" id="customer_name" class="form-control" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>Customer Address: </label></td>
                                   <td><input id="customer_address" type="text" class="form-control" name="customer_address"  required pattern="([A-Za-z0-9\s]){1,}" title="Special Characters not allowed."></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>City: </label></td>
                                   <td><input id="city" type="text" class="form-control" name="city" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>State: </label></td>
                                   <td><input id="state" type="text" class="form-control" name="state" required pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>Pincode: </label></td>
                                   <td><input id="pincode" type="tel" class="form-control" name="pincode" required pattern="^\d{6}$" title="Only numbers allowed.Pincode should be of 6 digits."></td>  
                                </tr>
                                <tr class="form-group">
                                   <td><label>Contact Person Name: </label></td>
                                   <td><input id="contact_name" type="text" class="form-control" name="contact_name" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>Contact Person Number: </label></td>
                                   <td><input id="contact_number" type="tel" class="form-control" name="contact_number" required pattern="^\d{10}$" title="Enter 10-digits only!"></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>Contact Person Email: </label></td>
                                   <td><input id="contact_email" type="email" class="form-control" name="contact_email" required></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>Bandwidth Size: </label></td>
                                   <td><input id="bandwidth_size" type="number" min="1" class="form-control" name="bandwidth_size" required ></td>
                                </tr>
                                <tr class="form-group">
                                   <td><label>Feasibility Status: </label></td>
                                   <td><input id="feasiblity_status" type="text" class="form-control" name="feasiblity_status" required pattern="([A-Za-z0-9\s]){1,}" title="Special Characters not allowed."></td>
                                </tr>
                                <tr class="form-group">
                                    <td><label>Fiber: </label></td>
                                    <td><input id="fiber" type="text" class="form-control" name="fiber" required pattern="([A-Za-z0-9\s]){1,}" title="Special Characters not allowed."></td>  
                                </tr>
                                <tr class="form-group">
                                   <td><label>Radio Frequency: </label></td>
                                   <td><input id="radio_frequency" type="number" min="1" class="form-control" name="radio_frequency" required ></td>
                                </tr>
                                <tr class="form-group">
                                    <td></td>
                                    <td>
                                       <button type="reset" name="clear" class="btn btn-danger">Clear!</button>
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
@endsection