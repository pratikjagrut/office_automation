@extends('layouts.app')

@section('title', 'Refund Request')

@section('content')
   
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <b>Refund</b>
                </div>
                <div class="panel-body">
                    <form action="/refund" method="post">
                        {{csrf_field()}}
                        <table class="table table-striped">
                            <tr class="from-group">
                                <td><label>Customer User Id: </label></td>
                                <td>
                                    <input id="customer_id" type="text" class="form-control" name="customer_id" required="true">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Customer Name: </label></td>
                                <td>
                                    <input id="customer_name" type="text" class="form-control" name="customer_name" required="true" pattern="([A-Za-z\s]){3,}" title="Only letters are allowed. Minimum 3 letters required.">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Bank Name: </label></td>
                                <td>
                                    <select name="bank" required="true" class="form-control">
                                        <option value="">Select</option>
                                        <option value="allahabad"> Allahabad Bank</option>
                                        <option value="andhra">Andhra Bank</option>
                                        <option value="baroda">Bank of Baroda</option>
                                        <option value="india">Bank of India</option>
                                        <option value="maharashtra">Bank of Maharashtra</option>
                                        <option value="canara">Canara Bank</option>
                                        <option value="central">Central Bank of India</option>
                                        <option value="corporation">Corporation Bank</option>
                                        <option value="dena">Dena Bank</option>
                                        <option value="indian">Indian Bank</option>
                                        <option value="overseas">Indian Overseas Bank</option>
                                        <option value="idbi">IDBI Bank</option>
                                        <option value="oriental">Oriental Bank of Commerce</option>
                                        <option value="sind">Punjab and Sind Bank</option>
                                        <option value="punjab">Punjab National Bank</option>
                                        <option value="state">State Bank of India</option>
                                        <option value="syndicate">Syndicate Bank</option>
                                        <option value="uco">UCO Bank</option>
                                        <option value="union">Union Bank of India</option>
                                        <option value="united">United Bank of India</option>
                                        <option value="vijaya">Vijaya Bank</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>If Other: </label></td>
                                <td>
                                    <input id="other" type="text" class="form-control" name="other"  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Bank Account Number: </label></td>
                                <td>
                                    <input id="account_no" type="tel" class="form-control" min="1" name="account_no" required="true" pattern="^\d{16}$" title="Only 16 digits are allowed!">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>IFSC code: </label></td>
                                <td>
                                    <input id="ifsc_no" type="text" class="form-control" name="ifsc_no" required="true" pattern="([A-Za-z0-9\s]){3,}" title="Alphanumeric code required. Code length should be 11">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Bank Branch: </label></td>
                                <td>
                                    <input id="branch" type="text" class="form-control" name="branch" required="true" pattern="([A-Za-z\s]){3,}" title="Minimum 3 letters required. Only uppercase and lower case letters allowed.">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Reason: </label></td>
                                <td>
                                    <input id="reason" type="text" class="form-control" name="reason" required="true" pattern="([A-Za-z\s]){3,}" title="Only alphabets accepted.Min 3 letters required.">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Refund Amount: </label></td>
                                <td>
                                    <input id="refund_amount" type="number" min="1" class="form-control" name="refund_amount" required="true">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Mail Date: </label></td>
                                <td>
                                    <input id="mail_date" type="date" class="form-control" name="mail_date" required>
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Assigned to: </label></td>
                                <td>
                                    <input id="assigned_to" type="text" class="form-control" name="assigned_to" required="true"  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Generated by: </label></td>
                                <td>
                                    <input id="generated_by" type="text" class="form-control" name="generated_by" value="{{Auth::user()->name}}" readonly="true" required="true">
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td>
                                    
                                </td>
                                <td>
                                    <input type="reset" class="btn btn-danger" value="Clear Form">
                                    <input type="submit" class="btn btn-success" value="Submit">
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
