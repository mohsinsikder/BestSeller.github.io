@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Users</a> <a href="#" class="current">View User</a> </div>
    <h1>View User</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Users</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-busered data-table">
              <thead>
                <tr>
                  <th>User ID:</th>
                  <th> Name</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Pincode</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Status</th>

                </tr>
              </thead>

              <tbody>
                  @foreach($users as $user)
                <tr class="gradeX">
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->city}}</td>
                  <td>{{$user->state}}</td>
                  <td>{{$user->country}}</td>
                  <td>{{$user->pincode}}</td>
                  <td>{{$user->mobile}}</td>
                  <td>{{$user->email}}</td>
                  <td class="center">
                    @if($user->status==1)
                    <span style="color:green">Active</span>
                    @else
                   <span style="color: red">Inactive</span>
                   @endif
                  </td>

                </tr>
            @endforeach
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
