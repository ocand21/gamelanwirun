@extends('auth.main')

@section('title', '| Reset Password')

@section('content')

<div class="login-page">
    <div class="login-main">
    	 <div class="login-head">
				<h1>Lupa Password</h1>
			</div>
			<div class="login-block">
				<form method="POST" action="{{route('password.email')}}">
          {!! csrf_field() !!}
					<input type="text" name="email" placeholder="Email" required="">
          <input type="hidden" name="__token">
					<input type="submit" id="button" name="submit" value="Kirim Email">
				</form>
        <a href="{{route('login')}}" class="btn btn-default btn-block" style="margin-top: 10px"><< Kembali</a>
			</div>
      </div>
</div>


@endsection
