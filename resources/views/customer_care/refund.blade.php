@extends('layouts.app')

@section('title', 'Export Finished Jobs')

@section('content')
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Refund</div>

                 <div class="panel-body">
                    <div class="modal-body">
                     <form action="/closeJob">
                      <table class="table table-striped">
                        <tr class="from-group">
                            <td><label>Customer User_Id: </label></td>
                            <td>
                                <input id="user_id" type="text" class="form-control" name="user_id" value="" required >
                            </td>
                        </tr>
                        
                        <tr class="from-group">
                            <td><label>Customer Name: </label></td>
                            <td><input id="name" type="text" class="form-control" name="name" value="" required pattern="([A-Za-z\s]){3,}" title="Only letters are allowed. Minimum 3 letters required."></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Bank Account Number: </label></td>
                            <td><input id="account_no" type="tel" class="form-control" name="account_no" required pattern="^\d{16}$" title="Only 16 digits are allowed!"></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>IFSC Number: </label></td>
                            <td><input id="ifsc_code" type="tel" class="form-control" name="ifsc_code" required pattern="^\d{11}$" title="Only 11 digits are allowed!"></td>
                        </tr>
                        

                        <tr class="from-group">
                            <td><label>Bank Name: </label></td>
                            <td><select name="bank_name" class="form-control">
                                <option value="select">Select</option>
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
                                <option value="Other">Other</option>
                            </select></td>
                            
                        </tr>
                        <tr class="from-group">
                            <td><label>If Other: </label></td>
                            <td><input id="other" type="text" class="form-control" name="other"></td>
                        </tr>



                        <tr class="from-group">
                            <td><label>Bank Branch: </label></td>
                            <td><input id="bank_branch" type="text" class="form-control" name="bank_branch" required pattern="([A-Za-z\s]){3,}" title="Minimum 3 letters required. Only uppercase and lower case letters allowed."></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Reason: </label></td>
                            <td><input id="reason" type="text" class="form-control" name="reason" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Mail Date: </label></td>
                            <td><input id="mail_date" type="text" class="form-control" name="mail_date" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Refund Status: </label></td>
                            <td><select name="refund_status" class="form-control">
                                <option value="select">Select</option>
                                <option value="approve">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="reject">Rejected</option>
                            </select></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Done Date: </label></td>
                            <td><input id="done_date" type="date" class="form-control" name="done_date" required></td>
                        </tr>
                        
                        <tr class="from-group">
                            <td><label>UTR Number: </label></td>
                            <td><input id="utr_no" type="tel" class="form-control" name="utr_no" required pattern="^\d{11}$" title="Max 11 digits are allowed!"></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Assigned to: </label></td>
                            <td><input id="assigned" type="text" class="form-control" name="assigned" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Generated by: </label></td>
                            <td><input id="generate" type="text" class="form-control" name="generate" required></td>
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
