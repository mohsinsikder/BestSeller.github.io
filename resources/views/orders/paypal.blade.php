@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>

		</div>
	</section>

	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR PAYPAL ORDER HAS BEEN PLACED</h3>
				<p>You order number is {{Session::get('order_id')}} and total payable about is &#2547; {{Session::get('grand_total')}} </p>
				<p>please Make payment by clicking on below Payment Button</p>

				<form action="{{route('user.paypal')}}" method="get">
					@csrf
			  <input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="business" value="mohsinsikder-buyer@gmail.com">
				  <input type="hidden" name="item_name" value="{{Session::get('order_id')}}">
				  <input type="hidden" name="item_number" value="{{Session::get('order_id')}}">
				  <input type="hidden" name="amount" value=" &#2547; {{Session::get('grand_total')}}">
				<button id="bKash_button" class="btn btn-success">Pay With Paypal</button>
			</form>
			</div>
		</div>
	</section>

@endsection
<?php
Session::forget('grand_total');
Session::forget('order_id');

 ?>
