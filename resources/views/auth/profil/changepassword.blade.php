@extends('main')

@section('title', '| Ganti Password')

@section('content')
<div class="inner-block">
  <div class="inbox">
    	 	<div class="col-md-12 compose-right">
					<div class="inbox-details-default">
						<div class="inbox-details-heading">
							Ganti Password
						</div>
						<div class="inbox-details-body">
							<div class="alert alert-info">
								Silakan masukkan password lama dan password baru
							</div>
              <form class="com-mail" action="{{ route('auth.profil.changePassword') }}" method='POST'
              enctype="multipart/form-data">
          <div class="form-group">
            <label>Password Lama</label>
            <input type="password" class="form-control" name="current_password">
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" class="form-control" name="new_password">
          </div>
          <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input type="password" class="form-control" name="new_password_confirmation">
          </div>
          <button type="submit" class="btn btn-outline btn-info">Simpan</button>
          <input type="hidden" name="_token" value="{{ Session::token() }}">
            <a href="" type="reset" class="btn btn-outline btn-warning">Batal</a>
        </form>
		</div>
					</div>
				</div>

          <div class="clearfix"> </div>
   </div>
</div>
@endsection
