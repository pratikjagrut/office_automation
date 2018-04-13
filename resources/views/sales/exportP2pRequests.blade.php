@extends('layouts.app')

@section('title', 'Manage Services Reports')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-7">
                <div class="well">
                    <form action="/p2pRequests" method="get">
                        <table class="table-condensed">
                            <tr class="form-group">
                                <td>
                                    <select class="form-control selectpicker" name="job_id" id="job_id" data-live-search="true" title="Job Id">
                                        @if (count($p2p_requests) > 0)
                                            @foreach ($p2p_requests as $p2p_request)
                                                @if ($p2p_request->job_id != null)
                                                    <option data-tokens="{{$p2p_request->job_id}}" value="{{$p2p_request->job_id}}">{{ucwords($p2p_request->job_id)}}
                                                    </option>
                                                @endif
                                            @endforeach     
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker" name="customer_name" id="customer_name" data-live-search="true" title="Customer Name">
                                        @if (count($customers) > 0)
                                            @foreach ($customers as $customer)
                                                @if ($customer->customer_name != null)
                                                    <option data-tokens="{{$customer->customer_name}}" value="{{$customer->customer_name}}">{{ucwords($customer->customer_name)}}
                                                    </option>
                                                @endif
                                            @endforeach     
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker" name="contact_person_name" id="contact_person_name" data-live-search="true" title="Cont. P. Name">
                                        @if (count($contact_person_names) > 0)
                                            @foreach ($contact_person_names as $contact_person_name)
                                                @if ($contact_person_name->contact_person_name != null)
                                                    <option data-tokens="{{$contact_person_name->contact_person_name}}" value="{{$contact_person_name->contact_person_name}}">{{ucwords($contact_person_name->contact_person_name)}}
                                                    </option>
                                                @endif
                                            @endforeach     
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control selectpicker" name="approval" id="approval" title="Approval">
                                        <option value="approved">Approved</option>
                                        <option value="denied">Denied</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" name="filter" class="btn btn-info">Search</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="well pull-right">
                    <button onclick="printDiv()" class="btn btn-success">Print</button>
                    <button href="" class="btn btn-warning" id="btnExportToExcel">Download To Excel</button>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				@if (count($p2p_requests) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center">
							<b>Manage services</b>
						</div>
						<div class="panel-body table-responsive">
							<table class="table table-striped table-bordered table-condensed" style="border: 1px solid #ccc;" id="output">
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Job Id</th>
                                    <th>Customer Name</th>
                                    <th>Cont. P. Name</th>
                                    <th>Cont. P. Number</th>
                                    <th>Cont. P. Email</th>
                                    <th>A end Address</th>
                                    <th>A end City</th>
                                    <th>A end State</th>
                                    <th>A end Pincode</th>
                                    <th>A end Lat/Long</th>
                                    <th>B end Address</th>
                                    <th>B end City</th>
                                    <th>B end State</th>
                                    <th>B end Pincode</th>
                                    <th>B end Lat/Long</th>
                                    <th>Network Priority</th>
                                    <th>Other Requirments</th>
                                    <th>Generated By</th>
                                    <th>A end feasibility</th>
                                    <th>B end feasibility</th>
                                    <th>Overall Feasiblity</th>
                                    <th>BTS Address</th>
                                    <th>Feasiblity Checked By</th>
                                    <th>Forwarded By</th>
                                    <th>Comment</th>
                                    <th>Approval</th>
                                    <th>Approval Note</th>
                                    <th>Approved/Denied By</th>
                                </tr>
                                @foreach ($p2p_requests as $request)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ ucwords($request->job_id) }}</td>
                                        <td>{{ ucwords($request->customer_name) }}</td>
                                        <td>{{ ucwords($request->contact_person_name) }}</td>
                                        <td>{{ ucwords($request->contact_person_no) }}</td>
                                        <td>{{ ucwords($request->contact_person_email) }}</td>
                                        <td>{{ ucwords($request->a_end_address) }}</td>
                                        <td>{{ ucwords($request->a_end_city) }}</td>
                                        <td>{{ ucwords($request->a_end_state) }}</td>
                                        <td>{{ ucwords($request->a_end_pincode) }}</td>
                                        <td>{{ ucwords($request->a_end_lat_long) }}</td>
                                        <td>{{ ucwords($request->b_end_address) }}</td>
                                        <td>{{ ucwords($request->b_end_city) }}</td>
                                        <td>{{ ucwords($request->b_end_state) }}</td>
                                        <td>{{ ucwords($request->b_end_pincode) }}</td>
                                        <td>{{ ucwords($request->b_end_lat_long) }}</td>
                                        <td>{{ ucwords($request->network_priority) }}</td>
                                        <td>{{ ucwords($request->other_requirments) }}</td>
                                        <td>{{ ucwords($request->generated_by) }}</td>
                                        <td>{{ ucwords($request->a_end_feasibility) }}</td>
                                        <td>{{ ucwords($request->b_end_feasibility) }}</td>
                                        <td>{{ ucwords($request->feasibility_status) }}</td>
                                        <td>{{ ucwords($request->bts_address) }}</td>
                                        <td>{{ ucwords($request->feasibility_checked_by) }}</td>
                                        <td>{{ ucwords($request->forwarded_by) }}</td>
                                        <td>{{ $request->comment }}</td>
                                        <td>{{ ucwords($request->approval) }}</td>
                                        <td>{{ $request->approval_note }}</td>
                                        <td>{{ ucwords($request->approved_by) }}</td>
                                    </tr>
                                @endforeach
                            </table>
						</div>
					</div>
				@else
				    <h2 class="text-center">NO DATA FOUND</h2>	
				@endif
			</div>
		</div>
	</div>

    <script type="text/javascript">
        function printDiv() {
            $('.delete').hide()
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
                    '<center><h2>Manage Servives Requests</h2><center>';
            htmlToPrint += divToPrint.outerHTML;
            newWin = window.open("");
            newWin.document.write(htmlToPrint);
            newWin.print();
            newWin.close()
        }
    </script>
    <!--Download excel-->

    <script type="text/javascript">
        $(document).ready(function() {
            $("#btnExportToExcel").click(function(e) {
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
                a.download = 'ManageServicesRequests-' + datetime + '.xls';
                a.click();
            });
        });
    </script>
@endsection
