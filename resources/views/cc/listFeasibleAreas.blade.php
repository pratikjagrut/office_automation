@extends('layouts.app')

@section('title', 'List Feasible Areas')

@section('content')
	<div class="container-fluid">
				<div class="row">
			<div class="col-md-7">
				<div class="well">
					<form action="/listFeasibleAreas" class="form-inline" method="get">
						<table class="table-condensed">
							<tr class="form-group">
								<td>
									<select class="form-control selectpicker" name="reseller_name" id="reseller_name" data-live-search="true" title="Reseller Name">
									    @if (count($resellers) > 0)
									        @foreach ($resellers as $reseller)
									            <option data-tokens="{{$reseller->reseller_name}}" value="{{$reseller->reseller_name}}">{{ucwords($reseller->reseller_name)}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="society" id="society" data-live-search="true" title="Society">
									    @if (count($societies) > 0)
									        @foreach ($societies as $society)
									            <option data-tokens="{{$society->society}}" value="{{$society->society}}">{{ucwords($society->society)}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="area" id="area" data-live-search="true" title="Area">
									    @if (count($areas) > 0)
									        @foreach ($areas as $area)
									            <option data-tokens="{{$area->area}}" value="{{$area->area}}">{{ucwords($area->area)}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="switch_location" id="switch_location" data-live-search="true" title="Switch Location">
									    @if (count($switch_locations) > 0)
									        @foreach ($switch_locations as $switch_location)
									            <option data-tokens="{{$switch_location->switch_location}}" value="{{$switch_location->switch_location}}">{{ucwords($switch_location->switch_location)}}</option>
									        @endforeach     
									    @endif  
									</select>
								</td>
								<td>
									<select class="form-control selectpicker" name="contact_person_name" id="contact_person_name" data-live-search="true" title="Contact Person Name">
									    @if (count($contact_persons) > 0)
									        @foreach ($contact_persons as $contact_person)
									            <option data-tokens="{{$contact_person->contact_person_name}}" value="{{$contact_person->contact_person_name}}">{{ucwords($contact_person->contact_person_name)}}</option>
									        @endforeach     
									    @endif  
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
			<div class="col-md-3"></div>
			<div class="col-md-2">
				<div class="well text-center">
					<a href="/exportFeasibleAreas" class="btn btn-warning">Export</a>
				</div>
			</div>
		</div>
		<div class="row">
		<div class="row">
			<div class="col-md-12">
				@if (count($feasibleAreas) > 0)
					<div class="panel panel-default">
						<div class="panel-heading text-center"><b>Feasible Areas</b></div>
						<div class="panel-body table-responsive">
							<form action="deleteFeasibleAreas" method="post">
								{{csrf_field()}}
								<table class="table table-striped table-bordered" style="border: 1px solid #ccc;">
									<tr>
										<th>Sr. No</th>
										<th>Reseller Name</th>
										<th>Building</th>
										<th>Society</th>
										<th>Area</th>
										<th>City</th>
										<th>Switch Location</th>
										<th>Contact Person Name</th>
										<th>Contact Person Number</th>
										<th>Generated By</th>
										<th>Edited By</th>
										@if (Auth::user()->user_type == 'admin')
											<th>Edit</th>
											<th>Delete</th>
										@endif
									</tr>
									@foreach ($feasibleAreas as $feasibleArea)
										<tr>
											<td>{{$loop->iteration}}</td>
											<td>{{ucwords($feasibleArea->reseller_name)}}</td>
											<td>{{ucwords($feasibleArea->building)}}</td>
											<td>{{ucwords($feasibleArea->society)}}</td>
											<td>{{ucwords($feasibleArea->area)}}</td>
											<td>{{ucwords($feasibleArea->city)}}</td>
											<td>{{ucwords($feasibleArea->switch_location)}}</td>
											<td>
												{{ucwords($feasibleArea->contact_person_name)}}
											</td>
											<td>
												{{ucwords($feasibleArea->contact_person_number)}}
											</td>
											<td>{{ucwords($feasibleArea->generated_by)}}</td>
											<td>
												{{ucwords($feasibleArea->edited_by)}}
											</td>
											@if (Auth::user()->user_type == 'admin')
												<td>
													<a class="btn btn-primary btn-sm" style="color: white;" data-toggle="modal" data-target="#editFeasibleArea" id="{{$feasibleArea->id}}" onclick="clck(this.id)">Edit</a>
												</td>
												<td>
													<input type="checkbox" name="feasibleAreaId[]" value="{{$feasibleArea->id}}">
												</td>
											@endif
										</tr>
									@endforeach		
								</table>
								@if (Auth::user()->user_type == 'admin')
									<input type="submit" name="feasibleAreas" value="Delete" class="btn btn-danger pull-right">
								@endif
							</form>
						</div>
					</div>
					@else
						<h1 class="text-center">No RECORD FOUND</h1>
				@endif
			</div>
		</div>
	</div>
		<!-- Modal -->
	  <div class="modal fade" id="editFeasibleArea" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title text-center"><b>Edit Feasible Area</b></h4>
	        </div>
	        <div class="modal-body">
				<form action="/editFeasibleArea" method="post">
					{{csrf_field()}}
				    <table class="table table-striped">
	                    <tr class="from-group">
	                        <td><label>Reseller Name: </label></td>
	                        <td>
	                           <input type="text" name="reseller_name" id="reseller_name" class="form-control"  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                        <td><label>Building Number: </label></td>
	                        <td>
	                           <input id="building" type="number" min="1" class="form-control" name="building">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                        <td><label>Society Name: </label></td>
	                        <td>
	                          <input id="society" type="text" class="form-control" name="society" pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                        <td><label>Area Name: </label></td>
	                        <td>
	                            <input id="area" type="text" class="form-control" name="area"  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                        <td><label>City: </label></td>
	                        <td>
	                            <input id="city" type="text" class="form-control" name="city" pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                        <td><label>Switch Location: </label></td>
	                        <td>
	                            <input id="switch_location" type="text" class="form-control" name="switch_location" pattern="([A-Za-z0-9\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                        <td><label>Contact Person Name: </label></td>
	                        <td>
	                            <input id="contact_person_name" type="text" class="form-control" name="contact_person_name" pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required.">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                       <td><label>Contact Person Number: </label></td>
	                       <td>
	                           <input id="contact_person_number" type="tel" class="form-control" name="contact_person_number" pattern="^\d{10}$" title="Enter 10-digits only!">
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                        <td><label>Edited by: </label></td>
	                        <td>
	                            <input id="edited_by" type="text" class="form-control" name="edited_by" value="{{Auth::user()->name}}" readonly="true" >
	                        </td>
	                    </tr>
	                    <tr class="from-group">
	                       <td></td>
	                       <td>
								<input type="hidden" name="feasibleAreaId" id="feasibleAreaId">
		                        <button type="clear" name="clear" class="btn btn-danger">Clear!</button>
		                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
	                      </td>
	                    </tr>	
	                </table>    
				</form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>
	<script type="text/javascript">
	  	function clck(id)
	  	{
	  		document.getElementById("feasibleAreaId").value = id
	  	}
	  </script>
@endsection