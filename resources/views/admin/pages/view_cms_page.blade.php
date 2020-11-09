@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">View Product</a> </div>
    <h1>View CMS Page</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>CMS</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Serial No:</th>
                  <th>CMS title</th>
                  <th>Description</th>
                  <th> CMS Pages URL</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                  @foreach($cmsPages as $cmspage)
                <tr class="gradeX">
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{$cmspage->title}}</td>
                  <td>{{$cmspage->description}}</td>
                  <td>{{$cmspage->url}}</td>
                  <td>@if($cmspage->status ==1) Active @else Inactive @endif</td>
                  <td>
                    <a href="{{route('admin.cms.edit',$cmspage->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <a href="{{route('admin.cms.delete',$cmspage->id)}}" class="btn btn-danger btn-mini">Delete</a>
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
