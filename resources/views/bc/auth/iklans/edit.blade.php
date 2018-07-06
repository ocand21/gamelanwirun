@extends('main')


@section('title', '| Iklan')

@section('content')

	@section('judulnav', 'Iklan')

	<section class="forms">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header d-flex align-items-center">
					<h3 class="h4">Edit Iklan</h3>
				</div>
				<div class="card-body">
					<form action="{{ route('iklans.update', $iklan->id) }}" method='POST' enctype="multipart/form-data">
						<div class="form-group">
							<label>Update Image</label>
							<input type="file" name="image">
						</div>
						<div class="form-group">
							<label>Nama Instrumen*</label>
							<input type="text" class="form-control" name="judul" value="{{ $iklan->judul }}">
						</div>
						<div class="form-group">
							<label>Url* (Menggunakan Imbuhan (-))</label>
							<input type="text" class="form-control" name="url" value="{{ $iklan->url }}" required>
						</div>
						<div class="form-group">
							<label>Jenis</label>
							<input type="text" class="form-control" name="jenis" value="{{ $iklan->jenis }}">
						</div>
						<div class="form-group">
							<label>Lokasi*</label>
							<input type="text" class="form-control" name="lokasi" value="{{ $iklan->lokasi }}">
						</div>
						<div class="form-group">
							<label>Harga</label>
							<input type="text" class="form-control" name="harga" value="{{ $iklan->harga }}">
						</div>
						<div class="form-group">
							<label>No Telepon/ No Handphone</label>
							<input type="text" class="form-control" name="notelp" value="{{ Auth::user()->notelp }}" disabled>
						</div>
						<div class="form-group">
							<label>Deskripsi Gamelan</label>
							<textarea name="deskripsi" rows="20" class="form-control">{{ $iklan->deskripsi }}</textarea>
						</div>
						<div class="form-group">
							<input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
						</div>
						<button type="submit" class="btn btn-outline btn-info">Simpan</button>
						<input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('PUT') }}
	   	 				<a href="{{ route('iklans.index') }}" type="reset" class="btn btn-outline btn-warning">Batal</a>
					</form>
				</div>
			</div>

		</div>

	</section>

@endsection
