@extends('layouts.app')

@section('title', 'New Job Entry')

@section('content')

<div class="container">
	<div class="row"> 
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<b>New Job Entry</b>
				</div>
				<div class="panel-body">
					<form action="/selectConsumer" method="get">
					    <table class="table table-striped">
					        <tr class="form-group">
					            <td>
					                <select name="consumer_type" class="selectpicker form-control" id="consumer_type" title="Select Consumer Type" required="true">
					                    <option value="partner">Partner</option>
					                    <option value="customer">Customer</option>
					                    <option value="reseller">Reseller</option>
					                </select>
					            </td>
					            <td id="partner">
					                <select class="selectpicker" data-live-search="true" title="Select Partner Name" name="partner_id">
						            	@if (count($partners) > 0)
                                            @foreach ($partners as $partner)
                                                <option value="{{$partner->name}}" data-tokens="{{$partner->name}}">
                                                	{{$partner->name}}
                                                </option>
                                            @endforeach
                                        @endif
					            	</select>
					            </td>
					            <td id="reseller">
					                <select class="selectpicker" data-live-search="true" title="Select Reseller Name" name="reseller_id">
						            	@if (count($resellers) > 0)
                                            @foreach ($resellers as $reseller)
                                                <option value="{{$reseller->name}}" data-tokens="{{$reseller->name}}">
                                                	{{$reseller->name}}
                                                </option>
                                            @endforeach
                                        @endif
					            	</select>
					            </td>
					            <td class="customer">
					                <select class="selectpicker" data-live-search="true" title="Select Circuit id Or Name" name="circuit_id">
						            	@if (count($customers) > 0)
                                            @foreach ($customers as $customer)
                                                @if ($customer->circuit_id != null)
                                                	<option value="{{$customer->circuit_id}}" data-tokens="{{$customer->circuit_id}}">
                                                		{{$customer->circuit_id}}
                                                	</option>
                                                @endif
                                                @if ($customer->name != null)
                                                	<option value="{{$customer->name}}" data-tokens="{{$customer->name}}">
                                                		{{$customer->name}}
                                                	</option>
                                                @endif
                                            @endforeach
                                        @endif
					            	</select>
					            </td>
					            <td><input type="submit" class="btn btn-primary form-control" name="submit_name" value="GO"></td>
					        </tr>
					    </table>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					@if ($consumer != null)
						<form action="/submitNewJob" method="post">
							{{ csrf_field() }}
							<table class="table table-striped">
								@if ($consumer->type == 'customer')
									<tr class="form-group">
								        <td><label>Circuit Id</label></td>
								        <td>
								            <input type="text" name="circuit_id" value=" {{ucwords($consumer->circuit_id)}} " class="form-control" required="true" readonly="true">
								        </td>
								    </tr>
								@endif
								<tr class="form-group">
							        <td><label>Name</label></td>
							        <td>
							            <input type="text" name="name" value=" {{ucwords($consumer->name)}} " class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Address</label></td>
							        <td>
							            <textarea type="text" name="address" class="form-control" required="true" readonly="true">{{ucwords($consumer->address)}}
							            </textarea>
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Area</label></td>
							        <td>
							            <input type="text" name="area" value="{{ucwords($consumer->area)}}" class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>City</label></td>
							        <td>
							            <input type="text" name="city" value="{{ucwords($consumer->city)}}" class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>State</label></td>
							        <td>
							            <input type="text" name="state" value="{{ucwords($consumer->state)}}" class="form-control" required="true" readonly="true">
							        </td>
							    </tr>
							    <tr class="form-group">
							        <td><label>Contact Details</label></td>
							        <td>
							            <input type="text" name="contact_details" class="form-control" value="{{$consumer->contact_details}}" required="true">
							        </td>
							    </tr>
	                            <tr class="form-group">
	                                <td><label>Case Reason</label></td>
	                                <td>
	                                    <input type="text" name="case_reason" class="form-control" required="true">
	                                </td>
	                            </tr>
	                            <tr class="form-group">
						            <td>
						                <select name="assign_job" class="selectpicker form-control" id="assign_job" title="Assign Job To">
						                    <option value="engineer">Engineer</option>
						                    <option value="team">Team</option>
						                </select>
						            </td>
						            <td id="engineer">
						            	<select class="selectpicker" data-live-search="true" title="Select Engineer" name="assign_to_engineer">
							            	@if ($engineers != null)
                                                @foreach ($engineers as $engineer)
                                                    @if ($engineer->name != 'admin')
                                                    	<option value="{{$engineer->name}}" data-tokens="{{$engineer->name}}">
                                                    		{{ucwords($engineer->name)}}
                                                    	</option>
                                                    @endif
                                                @endforeach
                                            @endif
						            	</select>
						            </td>
						            <td id="team">
						            	<select class="selectpicker" data-live-search="true" title="Select Team" name="assign_to_team">
							            	@if ($teams != null)
                                                @foreach ($teams as $team)
                                                    <option value="{{$team->department}}" data-tokens="{{$team->department}}">
                                                    	{{ucwords($team->department)}}
                                                    </option>
                                                @endforeach
                                            @endif
						            	</select>
						            </td>
						        </tr>
						        <tr class="form-group">
						            <td><label>Generated By</label></td>
						            <td>
						                <input type="text" name="generated_by" value="{{ucwords(auth()->user()->name)}}" class="form-control" required="true" readonly="true">
						            </td>
						        </tr>
	                            <input type="text" name="get_consumer_type" hidden="true" value="{{$consumer->type}}">

	                            <input type="text" name="generation_date" id="generation_date" readonly="true" hidden="true">

	                            <input type="text" name="assigned_to_level" id="asssigned_to_level" value="2" readonly="true" hidden="true">
	                            
	                            <script type="text/javascript">
	                            	$(document).ready(function() {
	                            		var timestamps = new Date()
	                            		document.getElementById("generation_date").value = timestamps.getTime()	
	                            	});
	                            </script>
						        <tr class="form-group">
						            <td><label></label></td>
						            <td>
						                <input type="submit" name="submit_query" class="form-control btn btn-success" required="true">
						            </td>
						        </tr>   
							</table>
						</form>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#engineer").hide()
		$("#team").hide()


		$("#assign_job").change(function(){
			var assign_job = $(this).val()
			if(assign_job == "engineer")
			{
				$("#engineer").show()
				$("#team").hide()
			}
			else
			{
				$("#engineer").hide()
				$("#team").show()
			}
		})
	})
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#partner").hide()
		$(".customer").hide()
		$("#reseller").hide()

		$("#consumer_type").change(function(){
			var consumer_type = $(this).val()
			if(consumer_type == "partner")
			{
				$("#partner").show()
				$(".customer").hide()
				$("#reseller").hide()
			}
			if(consumer_type == "customer")
			{
				$("#partner").hide()
				$(".customer").show()
				$("#reseller").hide()
			}
			if(consumer_type == "reseller")
			{
				$("#partner").hide()
				$(".customer").hide()
				$("#reseller").show()
			}
		})
	})
</script>
@endsection