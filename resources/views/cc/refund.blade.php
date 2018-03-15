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
                                <td><label>Mode of payment: </label></td>
                                <td>
                                    <select class="selectpicker form-control modeOfPayment" name="modeOfPayment" id="modeOfPayment" title="Select Mode of Payment" required="true">
                                       <option value="online banking">
                                            Online Banking
                                       </option>
                                       <option value="cheque">Cheque</option>
                                       <option value="cash">Cash</option> 
                                    </select>
                                </td>
                            </tr>
                            <tr class="from-group bank">
                                <td><label>Bank Name: </label></td>
                                <td>
                                    <select class="selectpicker form-control" name="bank" id="bank" data-live-search="true" title="Select Bank">
                                        @if (count($banks) > 0)
                                            @foreach ($banks as $bank)
                                                <option data-tokens="{{$bank->bank_name}}" value="{{$bank->bank_name}}">{{ucwords($bank->bank_name)}}</option>
                                            @endforeach     
                                        @endif  
                                    </select>
                                </td>
                            </tr>
                            <tr class="from-group other_bank">
                                 <td><label>Other Bank</label></td>
                                 <td>
                                     <input type="text" name="other_bank" id="other_bank" class="form-control">
                                 </td>
                            </tr>
                            
                            <tr class="from-group bank">
                                <td><label>Bank Branch: </label></td>
                                <td>
                                    <input id="branch" type="text" class="form-control" name="branch" pattern="([A-Za-z\s]){3,}" title="Minimum 3 letters required. Only uppercase and lower case letters allowed.">
                                </td>
                            </tr>
                            <tr class="from-group bank">
                                <td><label>Bank Account Number: </label></td>
                                <td>
                                    <input id="account_no" type="tel" class="form-control" min="1" name="account_no" title="Add zeros in front if number less than 16!">
                                </td>
                            </tr>
                            <tr class="from-group bank">
                                <td><label>IFSC code: </label></td>
                                <td>
                                    <input id="ifsc_no" type="text" class="form-control" name="ifsc_no" pattern="([A-Za-z0-9\s]){3,}" title="Alphanumeric code required. Code length should be 11">
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
                                    <input id="assigned_to" type="text" class="form-control" name="assigned_to" required="true"  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed. Minimum 3 letters required.">
                                </td>
                            </tr>
                            <tr class="from-group">
                                <td><label>Generated by: </label></td>
                                <td>
                                    <input id="generated_by" type="text" class="form-control" name="generated_by" value="{{Auth::user()->name}}" readonly="true" required="true">
                                </td>
                            </tr>
                            <tr class="form-group">
                                <td></td>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".bank").hide()
        $("#modeOfPayment").change(function(){
            var modeOfPayment = $(this).val()
            if(modeOfPayment == 'online banking')
            {
                $(".bank").show()
            }
            else
                $(".bank").hide()
                $(".other_bank").hide()
        })
    })
    $(document).ready(function(){
        $(".other_bank").hide()
        $("#bank").change(function(){
            var bank = $(this).val()
            if(bank == 'other')
            {
                $(".other_bank").show()
            }
            else
                $(".other_bank").hide()
        })
    })
</script>
@endsection
