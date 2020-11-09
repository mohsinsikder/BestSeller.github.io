@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form" style="margin-top: 20px"><!--form-->
		<div class="container">
			<div class="row">
        @include('errorMessage.message')
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{route('user.user_login')}}" id="loginForm" name="loginForm" method="POST">
							@csrf
							<input type="email" id="email" name="email" placeholder="Email Address" required/>
							<input type="password" id="password" name="password" placeholder="Password" required/>
							<!-- <span>
								<input type="checkbox" class="checkbox">
								Keep me signed in
							</span> -->
							<button type="submit" class="btn btn-default">Login</button><br>
							or Login With

							 <a href="{{route('login.google')}}" class="btn btn-danger btn-block">Login with Google</a>
							  <a href="{{route('login.facebook')}}" class="btn btn-success btn-block">Login with Facebook</a><br>
							<a href="{{route('user.forgot-password')}}">Forgot Password</a>
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
