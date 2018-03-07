@extends('layouts.app')

@section('title', 'List Man Power Requests')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="well">
                    <form action="/listManPowerRequirments" method="get"> 
                        <table class="table-condensed">
                            <tr class="form-group">
                                <td>
                                    <select class="form-control selectpicker" name="designation" id="designation" data-live-search="true" title="Designation">
                                        @if (count($designations) > 0)
                                            @foreach ($designations as $designation)
                                                <option data-tokens="{{$designation->vacancy_designation}}" value="{{$designation->vacancy_designation}}">{{ucwords($designation->vacancy_designation)}}</option>
                                            @endforeach     
                                        @endif  
                                    </select>                                    
                                </td>
                                <td>
                                   <select class="form-control selectpicker" name="status" id="status" data-live-search="true" title="Status">
                                       <option value="accepted">Accpted</option>
                                       <option value="pending">Pending</option>
                                       <option value="rejected">Rejected</option>  
                                    </select> 
                                </td>
                                <td>
                                    <select class="form-control selectpicker" name="generated_by" id="generated_by" data-live-search="true" title="Generated By">
                                        @if (count($engineers) > 0)
                                            @foreach ($engineers as $engineer)
                                                <option data-tokens="{{$engineer->generated_by}}" value="{{$engineer->generated_by}}">{{ucwords($engineer->generated_by)}}</option>
                                            @endforeach     
                                        @endif  
                                    </select>
                                </td>
                                <td>
                                    <input placeholder="Generated Date" class="form-control" type="text" onfocus="(this.type='date')" name="generated_date" onblur="(this.type='text')">
                                </td>
                                <td>
                                    <button type="submit" name="filter" class="btn btn-success">Search</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-2">
                <div class="well text-center">
                    <a href="/exportManPowerRequirments" class="btn btn-warning">Export</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (count($manPowerRequests) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading text-center"><b>Man Power Requests</b></div>
                        <div class="panel-body table-responsive">
                            <form action="/deleteManPowerRequest" method="post">
                                {{csrf_field()}}
                                <table class="table table-striped table-condensed table-bordered" style="border: 1px solid #ccc;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Designation</th>
                                        <th>No of vacancy</th>
                                        <th>Reason</th>
                                        <th>Priority</th>
                                        <th>Preference</th>
                                        <th>Qualification</th>
                                        <th>Status</th>
                                        <th>Comment</th>
                                        <th>JD</th>
                                        <th>Generated By</th>
                                        <th>Created At</th>
                                        <th>Edited By</th>
                                        <th>Edited At</th>
                                        <th>Acted By</th>
                                        <th>Action</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    @foreach ($manPowerRequests as $manPowerRequest)
                                        <tr>
                                            <td>{{$manPowerRequest->id}}</td>
                                            <td>
                                                {{ucwords($manPowerRequest->vacancy_designation)}}
                                            </td>
                                            <td>
                                                {{ucwords($manPowerRequest->no_of_vacancy)}}
                                            </td>
                                            <td>{{ucwords($manPowerRequest->reason)}}</td>
                                            <td>{{ucwords($manPowerRequest->priority)}}</td>
                                            <td>{{ucwords($manPowerRequest->preferences)}}</td>
                                            <td>
                                                {{ucwords($manPowerRequest->qualification)}}
                                            </td>
                                            <td>{{ucwords($manPowerRequest->status)}}</td>
                                            <td>{{ucwords($manPowerRequest->comment)}}</td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" style="color: white;" data-toggle="modal" data-target="#job_description" id="{{$manPowerRequest->job_description}}" onclick="job_description(this.id)">JD</a>
                                            </td>
                                            <td>
                                                {{ucwords($manPowerRequest->generated_by)}}
                                            </td>
                                            <td>
                                                {{ucwords($manPowerRequest->created_at)}}
                                            </td>
                                            <td>
                                                {{ucwords($manPowerRequest->edited_by)}}
                                            </td>
                                            <td>
                                                {{ucwords($manPowerRequest->updated_at)}}
                                            </td>
                                            <td>
                                                {{ucwords($manPowerRequest->acted_by)}}
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" style="color: white;" data-toggle="modal" data-target="#action" id="{{$manPowerRequest->id}}" onclick="action(this.id)">Action</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm" style="color: white;" data-toggle="modal" data-target="#edit" id="{{$manPowerRequest->id}}" onclick="edit(this.id)">Edit</a>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="delete[]" value="{{$manPowerRequest->id}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <input type="submit" class="btn btn-danger pull-right" name="deleteBtn" value="Delete">
                            </form>
                        </div>
                    </div>
                    @else
                        <h2 class="text-center">NO DATA FOUND</h2>  
                @endif
                <div class="text-center">{{$manPowerRequests->links()}}</div>  
            </div>
        </div>
    </div>
    <!-- Modal -->
      <div class="modal fade" id="job_description" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><b>Job Description</b></h4>
            </div>
            <div class="modal-body">
                <p id="jd" style="padding: 10px;"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="action" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><b>Take Action</b></h4>
            </div>
            <div class="modal-body">
                <form action="/actionOnRequests" method="post">
                    {{csrf_field()}}
                    <table class="table table-striped">
                        <tr class="form-group">
                            <td>Select Action:</td>
                            <td>
                                <select class="selectpicker form-control" title="Select Action" name="action" ="true">
                                    <option value="accepted">Accept</option>
                                    <option value="rejected">Reject</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td>Comment:</td>
                            <td>
                                <textarea name="comment" class="form-control"></textarea>
                            </td>
                        </tr>
                        <tr class="form-group">
                            <td>Acted By:</td>
                            <td><input type="text" name="acted_by" class="form-control" readonly="true" value="{{ucwords(Auth::user()->name)}}"></td>
                        </tr>
                        <tr class="form-group">
                            <td></td>
                            <td>
                                <input type="hidden" name="requestId" id="requestId">
                                <input type="submit" name="submitAction" class="btn btn-success pull-right">
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

      <!-- Modal -->
      <div class="modal fade" id="edit" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><b>Edit</b></h4>
            </div>
            <div class="modal-body">
                <form action="/editManPowerRequest" method="post">
                    {{csrf_field()}}
                    <table class="table table-striped">
                        <tr class="from-group">
                            <td><label>Vacancy Designation: </label></td>
                            <td><input id="vacancy_designation" type="text" class="form-control" name="vacancy_designation" ></td>
                        </tr>
                        <tr class="from-group">
                          <td><label>No. of vacancy: </label></td>

                          <td><input id="vacancy" type="number" class="form-control" name="no_of_vacancy"  pattern="([1-9\s]){1,}" title="Only numbers are allowed!"></td>
                        </tr>
                        <tr class="from-group">
                           <td><label>Reason: </label></td>
                           <td><input id="reason" type="text" class="form-control" name="reason" value="" ></td>
                        </tr>
                        <tr class="from-group">
                           <td><label>Priority: </la  bel></td>
                           <td><input id="priority" type="text" class="form-control" name="priority"  pattern="([A-Za-z\s]){1,}" title="Only letters are allowed."></td>
                        </tr>
                        <tr class="from-group">
                           <td><label>Preferences: </label></td>
                           <td><input id="preferences" type="text" class="form-control" name="preferences"  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed"></td>
                        </tr>
                        <tr class="from-group">
                          <td><label>Qualification: </label></td>
                          <td><input id="qualification" type="text" class="form-control" name="qualification"  pattern="([A-Za-z\s]){1,}" title="Only letters are allowed."></td>
                        </tr>
                    
                        <tr class="from-group">
                          <td><label>Job Description: </label></td>
                          <td><textarea name="job_description" id="article-ckeditor"></textarea></td>
                        </tr>
                        <tr class="from-group">
                          <td><label>Edited by: </label></td>
                          <td><input id="edited_by" type="text" class="form-control" name="edited_by" value="{{Auth::user()->name}}" readonly="true" ></td>
                        </tr>
                        <tr class="from-group">
                           <td>
                               <input type="hidden" name="requestId" id="requestId1">
                           </td>
                           <td>
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
        function job_description(jd)
        {
            $(document).ready(function() {
                $('#jd').html("<p>"+jd+"</p>")
            });
        }

        function action(id)
        {
            document.getElementById("requestId").value = id
        }

        function edit(id)
        {
            document.getElementById("requestId1").value = id
        }
      </script>
@endsection