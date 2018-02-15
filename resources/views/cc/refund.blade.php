@extends('layouts.app')

@section('title', 'Refund Request')

@section('content')
   
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Refund</div>
                <div class="panel-body">
                    <form action="/refund" method="post">
                    {{csrf_field()}}
                        <table class="table-striped table">
                            <tr class="corm-group">
                                <td><label>Customer User Id: </label></td>
                                <td>
                                    <input id="customer_id" type="text" class="form-control" name="customer_id" required="true">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Customer Name: </label></td>
                                <td><input id="customer_name" type="text" class="form-control" name="customer_name" required="true" pattern="([A-Za-z\s]){3,}" title="Only letters are allowed. Minimum 3 letters required."></td>
                            </tr>
                            <tr class="from-group">
                               <td><label>Bank Account Number: </label></td>
                               <td><input id="account_no" type="number" class="form-control" name="account_no" required="true"></td>
                            </tr>
                            <tr class="from-group">
                               <td><label>IFSC Number: </label></td>
                               <td><input id="ifsc_no" type="number" class="form-control" name="ifsc_no" required pattern="^\d{11}$" title="Only 11 digits are allowed!"></td>
                            </tr>
                        </table>    
                    </form>
                </div>
            </div>
         </div>            
    </div>
</div>





@endsection
