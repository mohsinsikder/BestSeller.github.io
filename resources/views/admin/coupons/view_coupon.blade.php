@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Coupons</a> <a href="#" class="current">View Coupon</a> </div>
    <h1>View Coupon</h1>
    @include('errorMessage.message')
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Coupons</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Serial No:</th>
                  <th>Coupon Code</th>
                  <th>Amount</th>
                  <th>Amount Type</th>
                  <th>Expire Date</th>
                  <th>Create Date</th>
                  <th> Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach($coupons as $coupon)
                <tr class="gradeX">
                  <td>{{ $loop->index+1 }}</td>
                  <td>{{$coupon->coupon_code}}</td>
                  <td>{{$coupon->amount}}
                    @if($coupon->amount_type =="percentage") % @else &#2547; @endif

                  </td>
                  <td >{{$coupon->amount_type}}</td>
                  <td>{{$coupon->expiry_date}}</td>
                  <td>{{$coupon->created_at}}</td>
                    <td>@if($coupon->status==1) Active @else Inactive @endif</td>
                  <td >

                    <a href="{{route('admin.coupon.edit',$coupon->id)}}" class="btn btn-primary btn-mini">Edit</a>
                   <a id="delCoupon" href="{{route('admin.coupon.delete',$coupon->id)}}" class="btn btn-danger btn-mini">Delete</a>

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
