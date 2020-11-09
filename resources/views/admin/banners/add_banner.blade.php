@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Banners</a> <a href="#" class="current">Add Banner</a> </div>
    <h1>Banners</h1>
      @include('errorMessage.message')
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Banner</h5>

          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{route('admin.banner.add')}}" name="add_banner" id="add_banner" enctype="multipart/form-data">
             @csrf

             <div class="control-group">
               <label class="control-label">Banner Image</label>
               <div class="controls">
                 <input type="file" name="image" id="image">
               </div>
             </div>

              <div class="control-group">
                <label class="control-label">Banner Title</label>
                <div class="controls">
                  <input type="text" name="title" id="title" minlength="5" maxlength="15" required>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Banner Link</label>
                <div class="controls">
                  <input type="link" name="link" id="link" required>
                </div>
              </div>





              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" value="1">

                </div>
              </div>

              <div class="form-actions">
                <input type="submit" value="Add Banner" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection
