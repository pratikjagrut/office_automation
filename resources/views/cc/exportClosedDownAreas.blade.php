@extends('layouts.app')

@section('title', 'Export Closed Down Areas')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7">
				<div class="well">
					<form action="/exportClosedDownAreas" method="get">	
						<table class="table-condensed">
							<tr class="form-group">
								<td>
									<select class="form-control selectpicker" name="downArea" id="downArea" data-live-search="true" title="Down Area">
									    @if (count($areas) > 0)
									        @foreach ($areas as $area)
									            <option data-tokens="{{$area->area}}" value="{{$area->area}}">{{ucwords($area->area)}}</option>
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
									<select class="form-control selectpicker" name="reason" id="reason" data-live-search="true" title="Reason">
									    @if (count($reasons) > 0)
									        @foreach ($reasons as $reason)
									            <option data-tokens="{{$reason->reason}}" value="{{$reason->reason}}">{{ucwords($reason->reason)}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<input type="date" name="downDate" class="form-control">
								</td>
								<td>
									<button type="submit" name="filter" class="btn btn-success">Search</button>
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
				@if (count($downAreas) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center">
							<b>Closed Down Areas</b>
						</div>
						<div class="panel-body table-responsive">
							<table class="table table-striped table-condensed table-bordered" style="border: 1px solid #ccc;" id="output">
								<tr id="row">
									<th>ID</th>
									<th>Area Name</th>
									<th>Reason</th>
									<th>Down Date Time</th>
									<th>TAT</th>
									<th>Assigned To</th>
									<th>Generated By</th>
									<th>Up Date Time</th>
									<th>Closed By</th>
								</tr>
								@foreach ($downAreas as $downArea)
									<tr>
										<td>{{$downArea->id}}</td>
										<td>{{ucwords($downArea->area)}}</td>
										<td>{{ucwords($downArea->reason)}}</td>
										<td>{{ucwords($downArea->down_day_time)}}</td>
										<td>{{ucwords($downArea->tat)}}</td>
										<td>{{ucwords($downArea->assigned_to)}}</td>
										<td>{{ucwords($downArea->generated_by)}}</td>
										<td>{{ucwords($downArea->up_day_time)}}</td>
										<td>{{ucwords($downArea->closed_by)}}</td>
									</tr>
								@endforeach
							</table>			
						</div>
					</div>
					@else
						<h2 class="text-center">NO DATA FOUND</h2>	
				@endif
				<!--<div class="text-center">{//{$downAreas->links()}}</div>-->
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
	                '<center><h2>Closed Down Areas</h2><center>';
	        htmlToPrint += divToPrint.outerHTML;
	        newWin = window.open("");
	        newWin.document.write(htmlToPrint);
	        newWin.print();
	        $('.delete').show()
	        newWin.close()
	    }
	</script>
	<!--Download excel-->

	<script type="text/javascript">
		$(document).ready(function() {
			$("#btnExportToExcel").click(function(e) {
				var row = document.getElementById("row");
				row.deleteCell(9);
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
			    a.download = 'ClosedDownAreas-' + datetime + '.xls';
			    a.click();
			    var cell = row.insertCell(9);
			    cell.innerHTML = "<b>Delete</b>";
			});
		});
	</script>
@endsection