@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">View Category</a> </div>
    <h1>View Category</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Serial No:</th>
                  <th>Category Name</th>
                  <th> Category Lavel</th>
                  <th>Description</th>
                  <th>Category URL</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                  @foreach($categories as $category)
                <tr class="gradeX">
                  <td>{{$loop->iteration}}</td>
                  <td>{{$category->name}}</td>
                  <td>{{$category->parent_id}}</td>
                  <td>{{$category->description}}</td>
                    <td>{{$category->url}}</td>
                  <td>{{$category->status}}</td>
                  <td class="center"><a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-primary btn-mini">Edit</a>  <a id="delCat" href="{{route('admin.category.delete',$category->id)}}" class="btn btn-danger btn-mini">Delete</a></td>
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
