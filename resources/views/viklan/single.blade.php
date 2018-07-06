@extends('main')

@section('title', '| Dashboard')

@section('content')
<div class="inner-block">
  <div class="cols-grids panel-widget">
  <div class="row mb40">
					<div class="col-md-12">
						<div class="blankpage-main img-responsive">
              <h2>{{ $iklan->judul }}</h2>
              <table class="table">
    						<tbody>
                                <tr>
                                    <th>Gambar</th>
                                    <td>
                                      @if($iklan->image1)
                                      <img src="{{ asset('images/iklans/' . $iklan->image1) }}" class="img-responsive">
                                      @endif
                                      @if($iklan->image2)
                                      <img src="{{ asset('images/iklans/' . $iklan->image2) }}" class="img-responsive">
                                      @endif
                                      @if($iklan->image3)
                                      <img src="{{ asset('images/iklans/' . $iklan->image3) }}" class="img-responsive">
                                      @endif
                                      @if($iklan->image4)
                                      <img src="{{ asset('images/iklans/' . $iklan->image4) }}" class="img-responsive">
                                      @endif
                                      @if($iklan->image5)
                                      <img src="{{ asset('images/iklans/' . $iklan->image5) }}" class="img-responsive">
                                      @endif
                                    </td>
                                </tr>
    							<tr>
	    							<th>Nama Instrumen</th>
                                    <td>{{ $iklan->judul }}</td>
	    						</tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $iklan->lokasi }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis</th>
                                    <td>{{ $iklan->jenis }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>{{ $iklan->harga }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $iklan->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Penjual</th>
                                    <td>{{ $iklan->users->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $iklan->users->email }}</td>
                                </tr>
                                <tr>
                                    <th>No Handphone</th>
                                    <td>{{ $iklan->users->notelp }}</td>
                                </tr>

                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $iklan->category->name }}</td>
                                </tr>

    						</tbody>
    					</table>
              <hr>

              @if(!$iklan->favouritedBy(Auth::user()))
              <span class="pull-right">
              <a href="#" onclick="event.preventDefault();
                                   document.getElementById('product-fav-form')
                                           .submit();">Add to Favourites</a>

              <form id="product-fav-form" class="hidden"
                    action="{{ route('produk.fav.store', $iklan) }}" method="POST">
                  {{ csrf_field() }}
              </form>
              </span>
              @endif
            </div>
					</div>
    </div>
	</div>



  <div class="clearfix"></div>

</div>
@endsection
