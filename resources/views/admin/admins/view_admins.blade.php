@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Admins/Sub Admins</a> <a href="#" class="current">View Admin/Sub Admin</a> </div>
    <h1>View Admin/Sub admin</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Admins/Sub Admins</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-busered data-table table-bordered">
              <thead>
                <tr>
                  <th style="text-align: left"> ID:</th>
                  <th style="text-align: left">UserName</th>
                  <th style="text-align: left">Status</th>
                </tr>
              </thead>

              <tbody>
                  @foreach($admins as $admin)
                <tr class="gradeX">
                  <td class="center">{{ $loop->index+1 }}</td>
                  <td class="center">{{$admin->username}}</td>
                  <td class="center">
                    @if($admin->status==1)
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
