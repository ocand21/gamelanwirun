@extends('auth.main')

@section('title', '| Reset Password')

@section('content')

<div class="login-page">
    <div class="login-main">
    	 <div class="login-head">
				<h1>Reset Password</h1>
			</div>
			<div class="login-block">
				<form method="POST" method="POST" action="{{ route('password.reset.post', ['token' => $token]) }}">
          {{csrf_field()}}
          <input type="hidden" name="token" value="{{ $token }}">


          					<input type="text" name="email" placeholder="Email" required="" value="{{ $email }}" readonly>
          					<input type="password" autofocus name="password" class="lock" placeholder="Password">
          					<input type="password" name="password_confirmation" class="lock" placeholder="Konfirmasi Password">
					<div class="forgot-top-grids">

						<div class="clearfix"> </div>
					</div>
					<input type="submit" id="button" name="submit" value="Reset Password">
				</form>
			</div>
      </div>
</div>


@endsection
