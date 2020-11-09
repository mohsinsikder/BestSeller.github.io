@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="#" class="current">View Product</a> </div>
    <h1>View Product</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Serial No:</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th> Product color</th>
                  <th>Product Code</th>
                  <th> Product Price</th>
                  <th>Product Image</th>
                  <th>Feature Item</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                  @foreach($products as $product)
                <tr class="gradeX">
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{$product->category_name}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_color}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>&#2547; {{$product->price}}</td>
                  <td>
                        @if(!empty($product->image))
                    <img src="{{asset('/images/backend_images/products/small/'.$product->image)}}" style="width: 60px">
                         @endif
                  </td>
                  <td>@if($product->feature_item==1) Yes @else No @endif</td>

                  <td >
                    <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                    <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-primary btn-mini">Edit</a>
                    <a href="{{route('admin.product.addAttributes',$product->id)}}"  class="btn btn-success btn-mini" title="Add Attributes">Add</a> <a href="{{url('/admin/product/add-images/'.$product->id)}}"  class="btn btn-info btn-mini" title="Add Images">Add</a>  <a id="delProduct" href="{{route('admin.product.delete',$product->id)}}" class="btn btn-danger btn-mini">Delete</a>

                    </td>
                </tr>


                <div id="myModal{{ $product->id }}" class="modal hide">
                  <div class="modal-header">
                     <button data-dismiss="modal" class="close" type="button">×</button>
                     <h3>{{$product->product_name}} Full Details</h3>
                   </div>
                   <div class="modal-body">
                     <p>Product ID: {{ $product->id }}</p>
                     <p>Category Name: {{ $product->category_name }}</p>
                     <p>Product name: {{ $product->product_name }}</p>
                     <p>Product Description: {{ $product->description }}</p>
                     <p>Product Color: {{ $product->product_color }}</p>
                     <p>Product Code: {{ $product->product_code }}</p>
                     <p>Product Price: {{ $product->price }}</p>
                   </div>
                  </div>
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
