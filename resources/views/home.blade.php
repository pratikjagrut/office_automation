@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>
                            <b>Profile Image</b>
                        </h3>
                    </div>
                    <div class="panel-body text-center">
                        <img src="/storage/profile_pics/{{ $profile->profile_pic }}" class="img-thumbnail" id="profile_pic">
                        <div class="well col-md-4 col-md-offset-4 text-center">
                            <h4>
                                <b>{{ ucwords(auth()->user()->user_type) }}</b>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>
                            <b>General Information</b>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Name</td>
                                <td>{{ ucwords(auth()->user()->name) }}</td>
                            </tr>
                            <tr>
                                <td>Employee Id</td>
                                <td>{{ auth()->user()->employee_id }}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{ ucwords($profile->designation) }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ ucwords(auth()->user()->gender) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>
                            <b>Contact Details</b>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Email</td>
                                <td>{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td>{{ $profile->phone_number }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ ucfirst($profile->address) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
@endsection