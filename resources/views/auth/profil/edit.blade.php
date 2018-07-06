@extends('main')

@section('title', '| Edit Profil')

@section('content')
<div class="inner-block">
  <div class="inbox">

    	 	<div class="col-md-12 compose-right">
					<div class="inbox-details-default">
						<div class="inbox-details-heading">
							Edit Profil
						</div>
						<div class="inbox-details-body">
							<div class="alert alert-info">
								Silakan berikan informasi mengenai iklan
							</div>
              <form class="com-mail" action="{{ route('auth.profil.update', $profil->id) }}" method='POST' enctype="multipart/form-data">
                <div class="form-group">
    									<div class="btn btn-default btn-file">
    										<i class="fa fa-image"> </i> Image
    										<input type="file" name="image">
    									</div>
    								</div>
                    <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" class="form-control" name="name" value="{{ $profil->name }}">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="{{ $profil->email }}" required>
          </div>
          <div class="form-group">
            <label>No Telp/ Handphone</label>
            <input type="text" class="form-control" name="notelp" value="{{ $profil->notelp }}">
          </div>
          @if ( Auth::user()->hasRole('seller'))
          <div class="form-group">
            <label>Nama Toko</label>
            <input type="text" class="form-control" name="store_name" value="{{ $profil->store_name }}">
          </div>
          <div class="form-group">
            <label>Deskripsi Toko</label>
            <textarea class="form-control" name="store_description">{{ $profil->store_description }}</textarea>
          </div>
          @endif
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="address" value="{{ $profil->address }}">
          </div>
          <button type="submit" class="btn btn-outline btn-info">Simpan</button>
          <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('PUT') }}
            <a href="" type="reset" class="btn btn-outline btn-warning">Batal</a>
        </form>
		</div>
					</div>
				</div>

          <div class="clearfix"> </div>
   </div>
</div>
@endsection
