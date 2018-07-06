@extends('main')

@section('title', '| Dashboard')

@section('content')
<div class="inner-block">
  <div class="inbox">

    	 	<div class="col-md-12 compose-right">
					<div class="inbox-details-default">
						<div class="inbox-details-heading">
							Buat Iklan Baru
						</div>
						<div class="inbox-details-body">
							<div class="alert alert-info">
								Silakan berikan informasi mengenai iklan
							</div>
						<form action="{{ route('iklans.store') }}" method="POST" class="com-mail"  enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="form-group">
    									<div class="btn btn-default btn-file">
    										<i class="fa fa-image"> </i>Image 1
    										<input type="file" name="image1" class="form-control"/>
    									</div>
                      <div class="btn btn-default btn-file">
    										<i class="fa fa-image"> </i>Image 2
    										<input type="file" name="image2" class="form-control"/>
    									</div>
                      <div class="btn btn-default btn-file">
    										<i class="fa fa-image"> </i>Image 3
    										<input type="file" name="image3" class="form-control"/>
    									</div>
    								</div>
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-image"> </i>Image 4
                      <input type="file" name="image4" class="form-control"/>
                    </div>
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-image"> </i>Image 5
                      <input type="file" name="image5" class="form-control"/>
                    </div>
            <div class="form-group">
							<label>Nama Instrumen*</label>
							<input type="text" class="form-control" name="judul">
						</div>
            <div class="form-group">
              <label>Kategori</label>
              <select class="form-control" name="category_id">
                <option value="--Pilih--">--Pilih--
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}
                @endforeach
              </select>
            </div>
						<div class="form-group">
							<label>No Telepon/ No Handphone</label>
							<input type="text" class="form-control" name="notelp" value="{{ Auth::user()->notelp }}" disabled>
						</div>
            <div class="form-group">
              <label>Lokasi*</label>
              <input type="text" class="form-control" name="lokasi" value="{{ Auth::user()->address }}" disabled>
            </div>
            <div class="form-group">
							<label>Volume</label>
							<input type="text" class="form-control" name="volume">
						</div>
            <div class="form-group">
							<label>Stok</label>
							<input type="text" class="form-control" name="stock" >
						</div>
            <div class="form-group">
							<label>Harga</label>
							<input type="text" class="form-control" name="harga" >
						</div>
          	<div class="form-group">
							<label>Deskripsi Gamelan</label>
              <input type="hidden" name="view_count">
							<textarea name="deskripsi" rows="20" class="form-control" ></textarea>
						</div>
						<div class="form-group">
							<input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
						</div>
            <div align="right">
							<a href="{{ route('iklans.index') }}" class="btn btn-warning btn-h1-spacing">Kembali</a>
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
