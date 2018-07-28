@extends('auth.main')

@section('title', '| Login')

@section('content')

<div class="login-page">
    <div class="login-main">
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
			<div class="login-block">
				<form method="POST" action="">
          {!! csrf_field() !!}
					<input type="text" name="email" placeholder="Email" required="">
					<input type="password" name="password" class="lock" placeholder="Password">
					<div class="forgot-top-grids">
						<div class="forgot-grid">
							<ul>
								<li>
									<input type="checkbox" id="brand1" value="">
									<label for="brand1"><span></span>Remember me</label>
								</li>
							</ul>
						</div>
						<div class="forgot">
							<a href="{{route('password.request')}}">Forgot password?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
					<input type="submit" id="button" name="submit" value="Login">
				</form>
			</div>
      </div>
</div>


@endsection
