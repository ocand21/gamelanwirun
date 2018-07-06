@extends('main')

@section('title', '| Iklan')

@section('content')
<div class="inner-block">
  <div class="cols-grids panel-widget">
  <div class="row mb40">
					<div class="col-md-12">
						<div class="blankpage-main img-responsive">
              <h2>Iklan</h2>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Judul</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Ditambahkan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @if($iklans->count())
                  @foreach($iklans as $iklan)
                    <tr>
                      <td>{{ $iklan->judul }}</td>
                      <td>{{ $iklan->harga }}</td>
                      <td>{{ $iklan->deskripsi }}</td>
                      <td>{{ $iklan->pivot->created_at->diffforHumans() }}</td>
                      <td>
                        <a href="#" onclick="event.preventDefault();
                        			         document.getElementById('product-fav-destroy-{{ $iklan->id }}')
                        			                 .submit();">
                        	Remove from Favourites
                        </a>

                        <form action="{{ route('produk.fav.destroy', $iklan) }}"
                              method="POST"
                              id="product-fav-destroy-{{ $iklan->id }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <th>Tidak memiliki daftar favorit :(</th>
                  </tr>
                @endif
          </tbody>
    					</table>

                </div>
					</div>
    </div>
	</div>



  <div class="clearfix"></div>

</div>
@endsection
