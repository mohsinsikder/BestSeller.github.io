@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form" style="margin-top: 20px"><!--form-->
		<div class="container">
			<div class="row">
        @include('errorMessage.message')
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form">
						<h2>update Account</h2>
						<form action="{{route('user.user_account')}}" id="accountForm" name="accountForm" method="POST" >
							@csrf
             	<input value="{{$userDetails->email}}" type="text" id="email" name="email" placeholder="Email"/>
							<input value="{{$userDetails->name}}" type="text" id="name" name="name" placeholder="Name"/>
						  <input value="{{$userDetails->address}}" type="text" id="address" name="address" placeholder="Address"/>
						  <input value="{{$userDetails->city}}" type="text" id="city" name="city" placeholder="City"/>
						  <input value="{{$userDetails->state}}" type="text" id="state" name="state" placeholder="State"/>
							<select id="country" name="country">
								<option value="">Select Country</option>
								@foreach($countries as   $country)
								<option value="{{$country->country_name}}" @if($country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>

								@endforeach
							</select>
						<input value="{{$userDetails->pincode}}" style="margin-top: 10px" type="text" id="pincode" name="pincode" placeholder="Pincode"/>
						<input value="{{$userDetails->mobile}}" type="text" id="mobile" name="mobile" placeholder="mobile"/>
							<button type="submit" class="btn btn-default">Update</button>
						</form>

					</div>
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form">
						<h2>Update Password</h2>
						<form class="form-horizontal" method="post" action="{{route('user.updatePassword')}}" name="passwordForm" id="passwordForm">
							@csrf
							<div class="control-group">
								<label class="control-label">Current Password</label>
								<div class="controls">
									<input type="password" name="current_pwd" id="current_pwd" />
									<span id="chkPwd"></span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">New Password</label>
								<div class="controls">
									<input type="password" name="new_pwd" id="new_pwd" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Confirm password</label>
								<div class="controls">
									<input type="password" name="confirm_pwd" id="confirm_pwd" />
								</div>
							</div>
							<div class="form-actions">
								<input type="submit" value="Update Password" class="btn btn-success">
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection
