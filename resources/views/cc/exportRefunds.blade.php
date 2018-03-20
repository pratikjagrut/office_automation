@extends('layouts.app')

@section('title', 'Export Refunds')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 col-sm-7">
                <div class="well">
                    <form action="/exportRefunds" method="get">   
                        <table class="table-condensed">
                            <tr class="form-group">
                                <td>
                                    <select class="form-control selectpicker" name="customer_id" id="customer_id" data-live-search="true" title="Customer Id">
                                        @if (count($customer_id) > 0)
                                            @foreach ($customer_id as $customer)
                                                <option data-tokens="{{$customer->customer_id}}" value="{{$customer->customer_id}}">{{$customer->customer_id}}</option>
                                            @endforeach     
                                        @endif  
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker" name="customer_name" id="customer_name" data-live-search="true" title="Customer Name">
                                        @if (count($customer_name) > 0)
                                            @foreach ($customer_name as $customer1)
                                                <option data-tokens="{{$customer1->customer_name}}" value="{{$customer1->customer_name}}">{{$customer1->customer_name}}</option>
                                            @endforeach     
                                        @endif  
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker" name="assigned_to" id="assigned_to" data-live-search="true" title="Assigned To">
                                        @if (count($engineers) > 0)
                                            @foreach ($engineers as $engineer)
                                                <option data-tokens="{{$engineer->assigned_to}}" value="{{$engineer->assigned_to}}">{{ucwords($engineer->assigned_to)}}</option>
                                            @endforeach     
                                        @endif  
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker" name="status" id="status" title="Status">
                                        <option value="done">Done</option>
                                        <option value="granted">Granted</option>
                                        <option value="rejected">Rejected</option>
                                        <option value="pending">Pending</option>  
                                    </select>
                                </td>
                                <td>
                                    <input placeholder="Refund Requested Date" class="form-control" type="text" onfocus="(this.type='date')" name="generated_date" onblur="(this.type='text')">
                                </td>
                                <td>
                                    <button type="submit" name="filter" class="btn btn-success">Search</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <div class="well text-center">
                    <button onclick="printDiv()" class="btn btn-success">Print</button>
                    <button href="" class="btn btn-warning" id="btnExportToExcel">Download To Excel</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (count($refunds) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><b>Refunds</b></div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped table-bordered" style="border: 1px solid #ccc;" id="output">
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Customer Id</th>
                                    <th>Customer Name</th>
                                    <th>Mode Of Payment</th>
                                    <th>Bank Name</th>
                                    <th>Account Number</th>
                                    <th>Bank Branch</th>
                                    <th>IFSC Code</th>
                                    <th>Amount</th>
                                    <th>Reason</th>
                                    <th>Mail Date</th>
                                    <th>Status</th>
                                    <th>UTR No</th>
                                    <th>Assigned To</th>
                                    <th>Generated By</th>
                                    <th>Generated Date</th>
                                    <th>Acted By</th>
                                </tr>
                                @foreach ($refunds as $refund)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ucwords($refund->customer_id)}}</td>
                                        <td>{{ucwords($refund->customer_name)}}</td>
                                        <td>{{ucwords($refund->mode_of_payment)}}</td>
                                        <td>{{ucwords($refund->bank)}}</td>
                                        <td>{{ucwords($refund->account_no)}}</td>
                                        <td>{{ucwords($refund->branch)}}</td>
                                        <td>{{ucwords($refund->ifsc_no)}}</td>
                                        <td>{{ucwords($refund->refund_amount)}}</td>
                                        <td>{{ucwords($refund->reason)}}</td>
                                        <td>{{ucwords($refund->mail_date)}}</td>
                                        <td>{{ucwords($refund->refund_status)}}</td>
                                        <td>{{ucwords($refund->utr_no)}}</td>
                                        <td>{{ucwords($refund->assigned_to)}}</td>
                                        <td>{{ucwords($refund->generated_by)}}</td>
                                        <td>{{$refund->created_at}}</td>
                                        <td>{{ucwords($refund->granted_by)}}</td>
                                    </tr>
                                @endforeach 
                            </table>
                        </div>
                    </div>
                    @else
                    <h1 class="text-center">NO DATA FOUND</h1>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function printDiv() {
            var divToPrint = document.getElementById('output');
            var htmlToPrint = '' +
                '<style type="text/css">' +
                'table th, td {' +
                'border:1px solid #000;' +
                'padding:0.5em;' +
                '}' +
                'table{' +
                'border-collapse: collapse;' +  
                '}'+
                'h3{'+
                'margin-left: 75%;'+
                '}'+
                '</style>'+
                '<h3>Sheng Li Telecom India Pvt Ltd</h3>'+
                '<center><h2>Extensions List</h2><center>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            $(".disable").show()
            newWin.close()
        }
    </script>

    <!--Download excel-->

    <script type="text/javascript">
        $(document).ready(function() {
            $("#btnExportToExcel").click(function(e) {
                e.preventDefault();
                //getting data from our table
                var data_type = 'data:application/vnd.ms-excel';
                var table_div = document.getElementById('output');
                var table_html = table_div.outerHTML.replace(/ /g, '%20');

                var currentdate = new Date(); 
                var month = ""+currentdate.getMonth()+1
                var date = currentdate.getDate()
                if(currentdate.getDate() < 10)
                    date = "0"+date
                
                var datetime = currentdate.getFullYear()+"-"+(month)+"-"+date

                var a = document.createElement('a');
                a.href = data_type + ', ' + table_html;
                a.download = 'Extensions-' + datetime + '.xls';
                a.click();
            });
        });
    </script>

@endsection