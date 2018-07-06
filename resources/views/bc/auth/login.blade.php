@extends('auth.main')
@section('title', '| Login')


@section('content')
<div class="page login-page">
    <div class="container d-flex align-items-center">
      <div class="form-holder has-shadow">
        <div class="row">
          <!-- Logo & Information Panel-->
          <div class="col-lg-6">
            <div class="info d-flex align-items-center">
              <div class="content">
                <div class="logo">
                  <h1>Bekonang Store</h1>
                </div>
                <p>Solo, Jawa Tengah</p>
              </div>
            </div>
          </div>
          <!-- Form Panel    -->
          <div class="col-lg-6 bg-white">
            <div class="form d-flex align-items-center">
              <div class="content">
                <form method="POST" action="">
                  {!! csrf_field() !!}
                  <div class="form-group">
                    <input class="input-material" name="email" type="email" autofocus>
                    <label for="lemail" class="label-material">Email</label>
                  </div>
                  <div class="form-group">
                    <input class="input-material" name="password" type="password" value="">
                    <label for="password" class="label-material">Password</label>
                  </div>
                  <div class="form-group">
								    <input type="checkbox" name="remember" value="Remember Me">Remember Me
							    </div>
                  <div class="form-group">
                    <a href="lupa.php">Lupa Password?</a>
                  </div>
                  <input type="submit" id="button" name="submit" class="btn btn-primary" value="Login">
                  <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyrights text-center">
      <p>Yayasan Nadzir Wakaf Banda MAS</p>
      <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
    </div>
  </div>


@endsection
