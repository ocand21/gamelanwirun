@extends('main')

@section('title', '| Profil')

@section('content')

    @section('judulnav', 'Profil')

    <section class="forms">
        <div class="row">
		<div class="col-lg-7" style="margin-left: 30px">
			<div class="card" class="table-responsive">

				<div class="card-header d-flex align-items-center">
					<h3 class="h4"></h3>
				</div>
				<div class="card-body">
						<table class="table">
    						<tbody>
                                <tr>
                                    @if (Auth::user()->image)
                                    <th>Foto</th>
                                    <td><img src="{{ Auth::user()->image }}" class="table-responsive"></td>
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
    						</tbody>
    					</table>
				</div>
			</div>

		</div>

        <div class="col-lg-4">
            <div class="card"  class="table-responsive">

                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Aksi</h3>
                </div>
                <div class="card-body" align="center">

                        <a href="{{ route('auth.profil.edit', Auth::user()->id) }}" class="btn btn-primary btn-block">Edit Profil</a>
                            <hr/>
                            <form method="POST" action="">
                            <input type="submit" value="Hapus" class="btn btn-danger btn-block"> <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('DELETE') }}
                            <hr/>
                            <a href="" class="btn btn-warning btn-block btn-h1-spacing">Kembali</a>
                            </form>
                </div>
            </div>

          </div>
        </div>


	</section>

@endsection
