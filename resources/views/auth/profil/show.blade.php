@extends('main')
@section('title', '| Profil')
@section('content')

<div class="inner-block">
  @if (!Auth::user()->address)
  <div class="alert alert-danger">
    Silakan lengkapi data diri Anda (Alamat)
  </div>
  @endif
  <div class="cols-grids panel-widget">
  <div class="row mb40">
					<div class="col-md-7">
						<div class="blankpage-main">
              <h2>Profil</h2>
              <table class="table">
    						<tbody>
                  <tr>
                    @if ($profil->image)
                    <th>Foto</th>
                    <td><img src="{{ asset('images/users/' . $profil->image) }}" class="img-responsive"></td>
                    @else
                    <th>Foto</th>
                    <td><img src="/images/avatar.png" class="img-fluid rounded-circle img-responsive"></td>
                    @endif
                  </tr>
    							<tr>
	    							<th>Nama Lengkap</th>
                    <td>{{ Auth::user()->name }}</td>
	    						</tr>
                  <tr>
                    <th>Email</th>
                    <td>{{ Auth::user()->email }}</td>
                  </tr>
                  <tr>
                    <th>No Telepon/ Handphone</th>
                    <td>{{ Auth::user()->notelp }}</td>
                  </tr>
                  <tr>
                    <th>Alamat</th>
                    <td>{{ Auth::user()->address }}</td>
                  </tr>
                  <tr>
                  @if ( Auth::user()->hasRole('seller'))
                    <th>Nama Toko</th>
                    <td>{{ Auth::user()->store_name }}</td>
                  </tr>
                  <tr>
                    <th>Deksripsi Toko</th>
                    <td>{{ Auth::user()->store_description }}</td>
                  </tr>
                  @endif
    						</tbody>
    					</table>
						</div>
					</div>

          <div class="col-md-4">
						<div class="blankpage-main">
              <a href="{{ route('auth.profil.edit', Auth::user()->id) }}" class="btn btn-primary btn-block">Edit Profil</a>
                            <hr/>
              <a href="{{ route('auth.profil.changePassword') }}" class="btn btn-warning btn-block btn-h1-spacing">Ganti Password</a>
						</div>
					</div>
    </div>
	</div>



  <div class="clearfix"></div>

</div>
@endsection
