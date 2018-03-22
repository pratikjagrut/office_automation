 @extends('layouts.app')

@section('title', 'ManPower Request')

@section('content')
   
 <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                  <b>Man Power Request Form</b>
                </div>
                <div class="panel-body table-responsive">
                    <form action="/manPower" method="post">
                        {{csrf_field()}}
                        <table class="table table-striped">
                            <tr class="from-group">
                                <td><label>Vacancy Designation: </label></td>
                                <td><input id="vacancy_designation" type="text" class="form-control" name="vacancy_designation" required></td>
                            </tr>
                            <tr class="from-group">
                              <td><label>No. of vacancy: </label></td>

                              <td><input id="vacancy" type="number" class="form-control" name="no_of_vacancy" required></td>
                            </tr>
                            <tr class="from-group">
                               <td><label>Reason: </label></td>
                               <td><input id="reason" type="text" class="form-control" name="reason" value="" required></td>
                            </tr>
                            <tr class="from-group">
                               <td><label>Priority: </la  bel></td>
                               <td>
                                  <select id="priority" type="text" class="selectpicker form-control" name="priority" title="Select priority">
                                      <option value="Immediate">Immediate</option>
                                      <option value="Within 15 days">Within 15 Days</option>
                                      <option value="Within 1 Month">Within 1 Month</option>
                                      <option value="Within 2 Months">Within 2 Months</option>
                                      <option value="Within 3 Months">Within 3 Months</option>
                                      <option value="3+ Months">3+ Months</option>
                                  </select>
                               </td>
                            </tr>
                            <tr class="from-group">
                               <td><label>Preferences: </label></td>
                               <td><input id="preferences" type="text" class="form-control" name="preferences" required></td>
                            </tr>
                            <tr class="from-group">
                              <td><label>Qualification: </label></td>
                              <td><input id="qualification" type="text" class="form-control" name="qualification" required></td>
                            </tr>
                            <tr class="from-group">
                          <td><label>Experience: </label></td>
                          <td>
                                <select id="experience" type="text" class="selectpicker form-control" name="experience" title="Select Experience">
                                    <option value="0-2 Years">0-2 Years</option>
                                    <option value="2-4 Years">2-4 Years</option>
                                    <option value="4-6 Years">4-6 Years</option>
                                    <option value="6-8 Years">6-8 Years</option>
                                    <option value="8-10 Years">8-10 Years</option>
                                    <option value="10+ Years">10+ Years</option>
                                </select>
                          </td>
                        </tr>
                            <tr class="from-group">
                              <td><label>Job Description: </label></td>
                              <td>
                                <textarea id="article-ckeditor" name="job_description" required></textarea>
                              </td>
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
@endsection

@push('scripts')
  <script type="text/javascript">
      function toggleSidebar(ref) {
        ref.classList.toggle('active');
        document.getElementById('sidebar').classList.toggle('active');
      }
  </script>

  <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
  <script>
      CKEDITOR.replace( 'article-ckeditor' );
  </script>
@endpush
