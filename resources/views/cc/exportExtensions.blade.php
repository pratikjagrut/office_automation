@extends('layouts.app')

@section('title', 'Export Extension')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7 col-sm-7">
				<div class="well">
					<form action="/exportExtensions" class="form-inline" method="get">
						<table class="table-condensed">
							<tr class="form-group">
								<td>
									<select class="form-control selectpicker" name="customer_id" id="customer_id" data-live-search="true" title="Customer Id">
									    @if (count($customers) > 0)
									        @foreach ($customers as $customer)
									            <option data-tokens="{{$customer->customer_id}}" value="{{$customer->customer_id}}">{{ucwords($customer->customer_id)}}</option>
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
									<select class="selectpicker form-control" name="status" id="status" title="Status">
										<option value="pending">Pending</option>
										<option value="granted">Granted</option>
										<option value="rejected">Rejected</option>
									</select>
								</td>
								<td>
									<input placeholder="Complaint Date" class="form-control" type="text" onfocus="(this.type='date')" name="complaint_date" onblur="(this.type='text')">
								</td>
								<td>
									<button type="submit" name="filter" class="btn btn-info">Search</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<div class="col-md-2 col-sm-2"></div>
			<div class="col-md-3 col-sm-3">
				<div class="well">
					<button onclick="printDiv()" class="btn btn-success">Print</button>
					<button href="" class="btn btn-warning" id="btnExportToExcel">Download To Excel</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				@if (count($extensions) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center"><b>Extensions</b></div>
						<div class="panel-body table-responsive">
							<table class="table table-striped table-bordered" style="border: 1px solid #ccc;" id="output">
								<tr id="row">
									<th>Sr .No</th>
									<th>Customer Id</th>
									<th>Complaint Date</th>
									<th>Expiry Date</th>
									<th>Reason</th>
									<th>Extension Days</th>
									<th>Assigned To</th>
									<th>Status</th>
									<th>Generated By</th>
									<th>Acted By</th>
								</tr>	
								@foreach ($extensions as $extension)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{ucwords($extension->customer_id)}}</td>
										<td>{{ucwords($extension->complaint_date)}}</td>
										<td>{{ucwords($extension->expiry_date)}}</td>
										<td>{{ucwords($extension->reason)}}</td>
										<td>{{ucwords($extension->extension_day)}}</td>
										<td>{{ucwords($extension->assigned_to)}}</td>
										<td>{{ucwords($extension->status)}}</td>
										<td>{{ucwords($extension->generated_by)}}</td>
										<td>{{ucwords($extension->granted_by)}}</td>
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