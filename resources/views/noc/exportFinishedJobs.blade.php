@extends('layouts.app')

@section('title', 'Export Finished Jobs')

@section('content')
	<div class="container-fluid">
			<div class="col-md-4">
				<div class="well">
					<form class="form-inline" action="/exportFinishedJobs" method="get">
					    <table class="table-condensed">
					    	<tr class="form-group">
					    		<td>
			    			      	<select class="selectpicker form-control" name="consumer_type" title="Select Consumer Type" required="true">
			    						<option value="">All</option>
			    						<option value="partner">Partner</option>
			    						<option value="customer">Customer</option>
			    						<option value="reseller">Reseller</option>	
			    					</select>
					    		</td>
					    		<td>
					    			<input type="submit" class="btn btn-success form-control" name="filter" value="Search"> 
					    		</td>
					    	</tr>
					    </table>
					</form>
				</div> 
			</div>
			<div class="col-md-5"></div>
			<div class="col-md-3 col-sm-3">
				<div class="well text-center">
					<button onclick="printDiv()" class="btn btn-success">Print</button>
					<button href="" class="btn btn-warning" id="btnExportToExcel">Download To Excel</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<b>NOC JOBS</b>
					</div>
					<div class="panel-body table-responsive">
						<table class="table table-striped table-bordered" id="finishedJobsTable" style="border: 1px solid #ccc;">
							@if (count($jobs) > 0)
								<tr>
									<th>Sr No</th>
									<th>Ticket</th>
									<th>Circuit Id</th>
									<th>Name</th>
									<th>Address</th>
									<th>Area</th>
									<th>City</th>
									<th>State</th>
									<th>Contact Details</th>
									<th>Generation Date</th>
									<th>Close Date</th>
									<th>Total Time</th>
									<th>Case Reason</th>
									<th>Trouble Description</th>
									<th>Assign To</th>
									<th>Generated By</th>
									<th>Transferred To Level</th>
									<th>Transferred To</th>
									<th>Transferred By</th>
									<th>Solution Remark</th>
									<th>Closed By</th>
								</tr>
								@foreach ($jobs as $job)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$job->ticket}}</td>
										<td>{{$job->circuit_id}}</td>
										<td>{{ucwords($job->name)}}</td>
										<td>{{ucwords($job->address)}}</td>
										<td>{{ucwords($job->area)}}</td>
										<td>{{ucwords($job->city)}}</td>
										<td>{{ucwords($job->state)}}</td>
										<td>{{$job->contact_details}}</td>
										<td>{{$job->created_at}}</td>
										<td>{{$job->close_date}}</td>
										<td>{{$job->total_time}}</td>
										<td>{{ucwords($job->case_reason)}}</td>
										<td>{{ucwords($job->trouble_description)}}</td>
										<td>{{ucwords($job->assign_to)}}</td>
										<td>{{ucwords($job->generated_by)}}</td>
										<td>{{ucwords($job->transferred_to_level)}}</td>
										<td>{{ucwords($job->transferred_to)}}</td>
										<td>{{ucwords($job->transferred_by)}}</td>
										<td>{{ucfirst($job->solution_remark)}}</td>
										<td>{{ucwords($job->closed_by)}}</td>
									</tr>
								@endforeach
							@endif
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	function printDiv() {
        var divToPrint = document.getElementById('finishedJobsTable');
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
                '<center><h2>Jobs</h2><center>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }
</script>
<!--Download excel-->

<script type="text/javascript">
	$(document).ready(function() {
			$("#btnExportToExcel").click(function(e) {
				e.preventDefault();
		    //getting data from our table
		    var data_type = 'data:application/vnd.ms-excel';
		    var table_div = document.getElementById('finishedJobsTable');
		    var table_html = table_div.outerHTML.replace(/ /g, '%20');

		    var currentdate = new Date(); 
	  	    var month = ""+currentdate.getMonth()+1
	  	    var date = currentdate.getDate()
	  	    if(currentdate.getDate() < 10)
	  	    	date = "0"+date
	  	    
	  	    var datetime = currentdate.getFullYear()+"-"+(month)+"-"+date

		    var a = document.createElement('a');
		    a.href = data_type + ', ' + table_html;
		    a.download = 'FinnishedJobs-' + datetime + '.xls';
		    a.click();
			});
	});
</script>
@endsection