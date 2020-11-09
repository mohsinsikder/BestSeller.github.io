@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form" style="margin-top: 20px"><!--form-->
  <div class="container">
    <div class="breadcrumbs">
      <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Check Out</li>
      </ol>
    </div>
    @include('errorMessage.message')
    <form action="{{route('product.checkout')}}" method="post">
      @csrf
    <div class="row">
      <div class="col-sm-4 col-sm-offset-1">
        <div class="login-form"><!--login form-->
          <h2>Bill To</h2>
          <div class="form-group">

            <input type="text" class="form-control" name="billing_name" id="billing_name" value="{{$userDetails->name}}"   placeholder=" Billing Name" />
          </div>
            <div class="form-group">
            <input type="text" class="form-control" name="billing_address" id="billing_address" value="{{$userDetails->address}}"  placeholder="  Billing Address" />
          </div>
            <div class="form-group">
            <input type="text" class="form-control" name="billing_city" id="billing_city" value="{{$userDetails->city}}"  placeholder=" Billing City" />
          </div>
            <div class="form-group">
            <input type="text" class="form-control" name="billing_state" id="billing_state" value="{{$userDetails->state}}"  placeholder="  Billing State" />
          </div>
            <div class="form-group">
              <select id="billing_country" name="billing_country">
                <option value="">Select Country</option>
                @foreach($countries as   $country)
                <option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>

                @endforeach
              </select>
          </div>
            <div class="form-group">
            <input type="text" class="form-control" name="billing_pincode" id="billing_pincode" value="{{$userDetails->pincode}}"  placeholder=" Billing Pincode" />
          </div>
            <div class="form-group">
            <input type="text" class="form-control" name="billing_mobile" id="billing_mobile" value="{{$userDetails->mobile}}"  placeholder=" Billing Mobile" />
          </div>
          <div class="form-check">
              <input value="{{$userDetails->name}}"  type="checkbox" class="form-check-input" id="copyAddress">
              <label class="form-check-label" for="copyAddress">Shipping Address same as Billing Address</label>
          </div>

        </div><!--/login form-->
      </div>
      <div class="col-sm-1">
        <h2 ></h2>
      </div>
      <div class="col-sm-4">
        <div class="signup-form"><!--sign up form-->
          <h2>Ship To</h2>
          <div class="form-group">
          <input type="text" class="form-control" name="shipping_name" id="shipping_name" value="{{$userDetails->name}}"   placeholder="Shipping Name" />
        </div>
          <div class="form-group">
          <input type="text" class="form-control" name="shipping_address" id="shipping_address" value="{{$userDetails->address}}"   placeholder="Shipping  Address" />
        </div>
          <div class="form-group">
          <input type="text" class="form-control" name="shipping_city" id="shipping_city" value="{{$userDetails->city}}"   placeholder="Shipping City" />
        </div>
          <div class="form-group">
          <input type="text" class="form-control" name="shipping_state" id="shipping_state" value="{{$userDetails->state}}"   placeholder="Shipping  State" />
        </div>
        <div class="form-group">
          <select id="shipping_country" name="shipping_country">
            <option value="">Select Country</option>
            @foreach($countries as   $country)
            <option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>

            @endforeach
          </select>
      </div>
          <div class="form-group">
          <input type="text" class="form-control" name="shipping_pincode" id="shipping_pincode" value="{{$userDetails->pincode}}"  placeholder="Shipping Pincode" />
        </div>
          <div class="form-group">
          <input type="text" class="form-control" name="shipping_mobile" id="shipping_mobile" value="{{$userDetails->mobile}}" placeholder="Shipping Mobile" />
        </div>

          <button type="submit" class="btn btn-success">Check Out</button>

        </div><!--/sign up form-->
      </div>
    </div>
  </div>
</form>
</section><!--/form-->

@endsection
