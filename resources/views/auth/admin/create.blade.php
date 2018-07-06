@extends('main')

@section('title', '| Tambah Seller')

@section('content')
<div class="inner-block">
  <div class="inbox">

    	 	<div class="col-md-12 compose-right">
					<div class="inbox-details-default">
						<div class="inbox-details-heading">
							Daftar Seller Baru
						</div>
						<div class="inbox-details-body">
							<div class="alert alert-info">
								Silakan berikan informasi mengenai seller
							</div>
						<form action="{{ route('seller.store') }}" method="POST" class="com-mail"  enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="form-group">
    									<div class="btn btn-default btn-file">
    										<i class="fa fa-image"> </i> Foto Seller;
    										<input type="file" name="image" class="form-control"/>
    									</div>
    								</div>
            <div class="form-group">
							<label>Nama*</label>
							<input type="text" class="form-control" name="name">
						</div>
						<div class="form-group">
							<label>Email*</label>
							<input type="text" class="form-control" name="email">
						</div>
            <div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control" name="address">
						</div>
            <div class="form-group">
							<label>No Telepon/ No Handphone</label>
							<input type="text" class="form-control" name="notelp">
						</div>
            <div class="form-group">
              <label>Nama Toko</label>
              <input type="text" class="form-control" name="store_name">
            </div>
            <div class="form-group">
              <label>Deskripsi Toko</label>
              <textarea class="form-control" name="store_description"></textarea>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
							<label>Konfirmasi Password</label>
							<input type="password" class="form-control" name="password_confirmation">
						</div>
            <div align="right">
							<a href="{{ route('seller.index') }}" class="btn btn-warning btn-h1-spacing">Kembali</a>
							<button type="submit" class="btn btn-outline btn-info">Simpan</button>
							<input type="hidden" name="_token" value="{{ Session::token() }}">
						</div>
							</form>
						</div>
					</div>
				</div>

          <div class="clearfix"> </div>
   </div>
</div>
@endsection
