@extends('layouts.backend.app')
@section('title')
   Profile Information
@endsection
@section('content')
<div class="container card">
    <div class="row my-3">
        <h2 class="m-auto"><strong>Profile Information</strong></h2>
    </div>
    <div class="row p-3">
        <div class="col-md-4 text-center">
        <img src="{{ asset('/storage/profile_photo/'. $profile->image) }}" 
        style="height: 200px; width: 170px; margin-top:90px" class="elevation-2" alt="User Image">
        </div>
        <div class="col-md-8">
            <div class="table-responsive-md">
                <table class="table">
                    <tr>
                        <a href="{{ route('landlord.profile.edit', $profile->id) }}" class="btn btn-info float-right my-4" >Edit Profile</a>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $profile->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $profile->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $profile->email }}</td>
                    </tr>
                
                    <tr>
                        <th>Contact</th>
                        <td>{{ $profile->contact }}</td>
                    </tr>

                </table>
              </div>
            
        </div>
    </div>
</div>
 @endsection


