@extends('layouts.app')
@section('title', 'Voice Over IP')

@section('content')
   

 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">Voice Over IP</div>

                    <div class="panel-body">
                        <div class="modal-body">
                            <form action="/voipForm" method="post">
                                {{csrf_field()}}
                                <table class="table table-striped">
                                    <tr class="from-group">
                                      <td><label>Date: </label></td>
                                       <td><input id="dates_manually" type="date" class="form-control" name="dates_manually" required></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Destination: </label></td>
                                      <td><input id="destination" type="text" class="form-control" name="destination" required pattern="([A-Za-z\s]){3,}" title="Numbers not allowed.Minimum 3 letters required."></td>
                                    </tr>
                                    <tr class="from-group">
                                       <td><label>Country Code: </label></td>
                                       <td><input id="country_code" type="number" min="1" class="form-control" name="country_code"  required></td>
                                    </tr>
                                    
                                    <tr class="from-group">
                                       <td><label>Area Code: </label></td>
                                       <td><input id="area_code" type="number" min="1" class="form-control" name="area_code" required></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Price: </label></td>
                                      <td><input id="price" type="number" min="1" class="form-control" name="price" required ></td>
                                    </tr>
                                    <tr class="from-group">
                                      <td><label>Status: </label></td>
                                      <td><input id="status" type="text" class="form-control" name="status" required pattern="([A-Za-z\s]){3,}" title="Only letters are allowed.Minimum 3 letters required."></td>
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
