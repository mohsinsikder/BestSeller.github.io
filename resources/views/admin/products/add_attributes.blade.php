@extends('layouts.adminLayout.admin_design')

@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">Add Product Attributes</a> </div>
    <h1>Attributes</h1>
      @include('errorMessage.message')
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product Attributes</h5>

          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{route('admin.product.addAttributes', $productDetails->id)}}" name="add_attribute" id="add_attribute" novalidate="novalidate" enctype="multipart/form-data">
             @csrf
             <input type="text" class="hidden" name="product_id" id="product_id" value="{{$productDetails->id}}">

              <div class="control-group">
                <label class="control-label">Product Name</label>
                  <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
              </div>
              <div class="control-group">
                <label class="control-label">Product Code</label>
            <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
              </div>
              <div class="control-group">
                <label class="control-label">Product Color</label>
             <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>
              </div>


              <div class="control-group">
                <label class="control-label"></label>

                <div class="field_wrapper">
                  <div>
                      <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px"/>
                      <input type="text" name="size[]" id="size" placeholder="Size" style="width: 120px"/>
                      <input type="text" name="price[]" id="price" placeholder="Price" style="width: 120px"/>
                      <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width: 120px"/>
                      <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                      <br>
                  </div>
              </div>

              </div>

              <div class="form-actions">
                <input type="submit" value="Add Attribute" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>



    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Product Attributes</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Serial No:</th>
                  <th>SKU</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                  @foreach($productDetails['attributes'] as $attribute)
                <tr class="gradeX">
                   <td>{{$attribute->id}}</td>
                   <td>{{$attribute->sku}}</td>
                   <td>{{$attribute->size}}</td>
                   <td>{{$attribute->price}}</td>
                    <td>{{$attribute->stock}}</td>
                    <td>


                  <a rel="{{$attribute->id}}" rel1="delete_attribut" href="javascript:" class="btn btn-danger btn-mini">Delete</a>

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
