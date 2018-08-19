@extends('main')

@section('title', '| Dashboard')

@section('content')
<div class="inner-block">
  <div class="inbox">

    	 	<div class="col-md-12 compose-right">
					<div class="inbox-details-default">
						<div class="inbox-details-heading">
							Edit Iklan
						</div>
						<div class="inbox-details-body">
							<div class="alert alert-info">
								Silakan berikan informasi mengenai iklan
							</div>

              <table class="table table-bordered text-center">
                <thead align="center">
                  <tr>
                    <th>Gambar</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @if($iklan->image1)
                    <td><img src="{{ asset('images/iklans/' . $iklan->image1) }}" align="center" class="img-responsive"></td>
                    @endif
                  </tr>
                  <tr>
                    @if($iklan->image2 = 'logo.png')
                    <td><img src="{{ asset('images/iklans/' . $iklan->image2) }}" align="center" class="img-responsive"></td>
                    @else
                    <td><img src="{{ asset('images/iklans/' . $iklan->image2) }}" align="center" class="img-responsive"></td>
                    <td>
                      <form method="POST" action="{{ route('iklans.delimage2', $iklan->id) }}">
                      <input type="submit" value="Hapus" class="btn btn-danger"> <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('DELETE') }}
                      </form>
                    </td>
                    @endif
                  </tr>
                  <tr>
                    @if($iklan->image3)
                    <td><img src="{{ asset('images/iklans/' . $iklan->image3) }}" align="center" class="img-responsive"></td>
                    <td>
                      <form method="POST" action="{{ route('iklans.delimage3', $iklan->id) }}">
                      <input type="submit" value="Hapus" class="btn btn-danger"> <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('DELETE') }}
                      </form>
                    </td>
                    @endif
                  </tr>
                  <tr>
                    @if($iklan->image4)
                    <td><img src="{{ asset('images/iklans/' . $iklan->image4) }}" align="center" class="img-responsive"></td>
                    <td>
                      <form method="POST" action="{{ route('iklans.delimage4', $iklan->id) }}">
                      <input type="submit" value="Hapus" class="btn btn-danger"> <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('DELETE') }}
                      </form>
                    </td>
                    @endif
                  </tr>
                  <tr>
                    @if($iklan->image5)
                    <td><img src="{{ asset('images/iklans/' . $iklan->image5) }}" align="center" class="img-responsive"></td>
                    <td>
                      <form method="POST" action="{{ route('iklans.delimage5', $iklan->id) }}">
                      <input type="submit" value="Hapus" class="btn btn-danger"> <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('DELETE') }}
                      </form>
                    </td>
                    @endif
                  </tr>

                </tbody>
              </table>
              <form action="{{ route('iklans.update', $iklan->id) }}" method='POST' enctype="multipart/form-data">
              <div class="form-group">
              @if($iklan->image1==null)
              <div class="btn btn-default btn-file">
                <i class="fa fa-image"> </i>Foto 1
                <input type="file" name="image1" class="form-control"/>
              </div>
              @endif
              @if($iklan->image2==null)
              <div class="btn btn-default btn-file">
                <i class="fa fa-image"> </i>Foto 2
                <input type="file" name="image3" class="form-control"/>
              </div>
              @endif
              @if($iklan->image3==null)
              <div class="btn btn-default btn-file">
                <i class="fa fa-image"> </i>Foto 3
                <input type="file" name="image3" class="form-control"/>
              </div>
              @endif
              @if($iklan->image4==null)
              <div class="btn btn-default btn-file">
                <i class="fa fa-image"> </i>Foto 4
                <input type="file" name="image4" class="form-control"/>
              </div>
              @endif
              @if($iklan->image5==null)
              <div class="btn btn-default btn-file">
                <i class="fa fa-image"> </i>Foto 5
                <input type="file" name="image5" class="form-control"/>
              </div>
              @endif
            </div>
            <div class="form-group">
							<label>Nama Instrumen*</label>
							<input type="text" class="form-control" name="judul" value="{{ $iklan->judul }}">
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
							<label>Volume</label>
							<input type="text" class="form-control" name="volume" value="{{ $iklan->volume }}">
						</div>
						<div class="form-group">
							<label>Stok</label>
							<input type="text" class="form-control" name="stock" value="{{ $iklan->stock }}">
						</div>
						<div class="form-group">
							<label>Harga</label>
							<input type="text" class="form-control" name="harga" value="{{ $iklan->harga }}">
						</div>
            <div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" disabled>
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

      <div class="clearfix"> </div>
  </div>
  </div>
@endsection
