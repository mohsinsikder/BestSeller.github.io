@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form" style="margin-top: 20px"><!--form-->
		<div class="container">
			<div class="row">
        @include('errorMessage.message')
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Forgot Password</h2>
						<form action="{{route('user.forgot-password')}}" id="forgotPasswordForm" name="forgotPasswordForm" method="POST">
							@csrf
							<input type="email" id="email" name="email" placeholder="Email Address" required/>

							<button type="submit" class="btn btn-default">Submit</button><br>

						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{route('user.user_register')}}" id="registerForm" name="registerForm" method="POST" >
              @csrf

              <input type="text" id="name" name="name" placeholder="Name"/>
							<input type="email" id="email" name="email" placeholder="Email Address"/>
							<input type="password" id="myPassword" name="password" placeholder="Password"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->


@endsection
