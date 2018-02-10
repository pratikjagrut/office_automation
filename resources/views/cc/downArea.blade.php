@extends('layouts.app')

@section('title', 'DownArea Request')

@section('content')
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">Down Areas</div>

                 <div class="panel-body">
                    <div class="modal-body">
                       <form action="/downArea" method="post">
                        {{csrf_field()}}
                      <table class="table table-striped">

                        <tr class="from-group">
                            <td><label>Area Name: </label></td>
                            <td><input id="area" type="text" class="form-control" name="area" required pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
                        </tr>
                         <tr class="from-group">
                            <td><label>Assigned to: </label></td>
                            <td><input id="assigned_to" type="text" class="form-control" name="assigned_to" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Down Reason: </label></td>
                            <td><input id="reason" type="text" class="form-control" name="reason" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Down Day Time: </label></td>
                            <td><input id="down_day_time" type="date" class="form-control" name="down_day_time" required></td>
                        </tr>
                        <tr class="from-group">
                            <td><label>Up Day Time : </label></td>
                            <td> <input id="up_day_time" type="date" class="form-control" name="up_day_time" required></td>
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