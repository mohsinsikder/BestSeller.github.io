@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Orders</a> <a href="#" class="current">View Order</a> </div>
    <h1>View Order</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Orders</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Order ID:</th>
                  <th>Order Date</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Ordered Products</th>
                  <th>Order Amount</th>
                  <th>Order Status</th>
                  <th> Payment Method</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                  @foreach($orders as $order)
                <tr class="gradeX">
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{$order->created_at}}</td>
                  <td>{{$order->name}}</td>
                  <td>{{$order->user_email}}</td>
                  <td>
                    	@foreach($order->orders as $pro)
                       {{$pro->product_code}}
                       {{$pro->product_qty}}
    									@endforeach
                    </td>
                  <td>&#2547; {{$order->grand_total}}</td>
                  <td>{{$order->order_status}}</td>
                  <td>{{$order->payment_method}}</td>
                  <td class="center" >
                    <a href="{{route('admin.order.view.details',$order->id)}}" target="_blank"  class="btn btn-success btn-mini">View Order Details</a>
                    <br>
                    <br>
                    <a href="{{route('admin.order.invoice',$order->id)}}" target="_blank"  class="btn btn-success btn-mini">View Order Invoice</a>
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
