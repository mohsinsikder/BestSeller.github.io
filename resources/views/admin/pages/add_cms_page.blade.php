@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">CMS Pages</a> <a href="#" class="current">Add CMS</a> </div>
    <h1>CMS Pages</h1>
      @include('errorMessage.message')
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add CMS</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{route('admin.cms.add')}}" name="add_cms" id="add_cms">
             @csrf
              <div class="control-group">
                <label class="control-label">CMS Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                  <textarea type="text" name="description" id="description"></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">CMS URL</label>
                <div class="controls">
                  <input type="text" name="url" id="url">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">
                </div>
              </div>
              <div class="form-actions">
                <input type="submit" value="Add CMS" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection
