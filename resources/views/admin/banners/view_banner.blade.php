@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">View Banner</a> </div>
    <h1>View Banner</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Banners</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Serial No:</th>
                  <th>Banner Title</th>
                  <th>Banner Link</th>
                  <th>Banner Image</th>
                  <th>Expire Date</th>
                  <th>Create Date</th>
                  <th> Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                  @foreach($banners as $banner)
                <tr class="gradeX">
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{$banner->title}}</td>
                  <td>{{$banner->link}}</td>
                  <td>

                    <img src="{{asset('/images/backend_images/banners/'.$banner->image)}}" style="width: 60px">

                  </td>
                  <td>{{$banner->created_at}}</td>
                  <td>{{$banner->updated_at}}</td>
                    <td>@if($banner->status==1) Active @else Inactive @endif</td>
                  <td >

                    <a href="{{route('admin.banner.edit',$banner->id)}}" class="btn btn-primary btn-mini">Edit</a>
                   <a id="delBanner" href="{{route('admin.banner.delete',$banner->id)}}" class="btn btn-danger btn-mini">Delete</a>

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
