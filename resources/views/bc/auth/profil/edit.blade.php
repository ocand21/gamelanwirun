@extends('main')


@section('title', '| Edit Profil')

@section('content')

	@section('judulnav', 'Edit Profil')

	<section class="forms">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3 class="h4">Edit Iklan</h3>
				</div>
				<div class="card-body">
					<form action="{{ route('auth.profil.update', Auth::user()->id) }}" method='POST' enctype="multipart/form-data">
						<div class="form-group">
							<label>Update Image</label>
							<input type="file" name="image">
						</div>
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" class="form-control" name="judul" value="{{ Auth::user()->name }}">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control" name="url" value="{{ Auth::user()->email }}" required>
						</div>
						<div class="form-group">
							<label>No Telp/ Handphone</label>
							<input type="text" class="form-control" name="jenis" value="{{ Auth::user()->notelp }}">
						</div>
						<div class="form-group">
							<input type="hidden" class="form-control" name="user_id" value="">
						</div>
						<button type="submit" class="btn btn-outline btn-info">Simpan</button>
						<input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('PUT') }}
	   	 				<a href="" type="reset" class="btn btn-outline btn-warning">Batal</a>
					</form>
				</div>
			</div>

		</div>

	</section>

@endsection
