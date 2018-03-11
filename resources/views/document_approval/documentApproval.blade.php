@extends('layouts.app')

@section('title', 'Document Approval')

@section('content')
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">DocumentApproval</div>

                    <div class="panel-body" id="scroll">
                        <div class="modal-body">
                       <form action="/documentApproval" method="post">
                        {{csrf_field()}}
                                <table class="table table-striped">
                                    
                                    <tr class="from-group">
                                      <td><label>Title: </label></td>
                                      <td><input type="text" name="title" id="title" class="form-control" required  pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                                    </tr>
                        
                                    <tr class="from-group">
                                       <td><label>File Path: </label></td>
                                       <td><input id="file_path" type="text" class="form-control" name="file_path"  required pattern="([A-Za-z0-9\s]){1,}" title="Special Characters not allowed."></td>
                                    </tr>
                                  
                                    <tr class="from-group">
                                      <td><label>Remark: </label></td>
                                      <td><input id="remark" type="text" class="form-control" name="remark" required pattern="([A-Za-z\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Approval: </label></td>
                                      <td><select name="approval" class="form-control">
                                          <option value="level_1">Level 1</option>
                                          <option value="level_2">Level 2</option>
                                          <option value="level_3">Level 3</option>
                                      </select></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Job ID: </label></td>
                                      <td><input id="job_id" type="text" class="form-control" name="job_id" required  pattern="([A-Za-z0-9\s]){1,}" title="Special Characters not allowed."></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Priority: </label></td>
                                      <td><input id="priority" type="text" class="form-control" name="priority" required pattern="([A-Za-z\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Deadline: </label></td>
                                       <td><input id="deadline" type="date" class="form-control" name="deadline" required></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Generated by: </label></td>
                                      <td><input id="generated_by" type="text" class="form-control" name="generated_by" value="{{Auth::user()->name}}" readonly="true" required></td>
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
