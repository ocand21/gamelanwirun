@extends('main')

@section('title', '| Dashboard')

@section('content')
<div class="inner-block">
  <div class="cols-grids panel-widget">
  <div class="row mb40">
					<div class="col-md-7">
						<div class="blankpage-main">
              <h2>{{ $iklan->judul }}</h2>
              <table class="table">
    						<tbody>

                                <tr>
                                    <th>Gambar</th>
                                    <td>
                                      @foreach($iklan->photos as $photo)
                                      <img src="{{ asset('images/iklans/' . $photo->filename) }}" class="img-responsive img-thumbnail" style="margin-bottom: 5px">
                                      @endforeach
                                    </td>
                                </tr>
    							<tr>
	    							<th>Nama Instrumen</th>
                                    <td>{{ $iklan->judul }}</td>
	    						</tr>
                                <tr>
                                    <th>Volume</th>
                                    <td>{{ $iklan->volume }}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>{{ $iklan->stock }}</td>
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
                                    <th>Alamat</th>
                                    <td>{{ $iklan->users->address }}</td>
                                </tr>
                                <tr>
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
						</div>
					</div>

          <div class="col-md-4">
						<div class="blankpage-main">
              <table class="table">
                            <tbody>
                                <tr>
                                    <td>Url Iklan</td>
                                    <td><a href="{{ url('iklan/'.$iklan->url) }}">{{url('iklan/'.$iklan->url) }}</a></td>
                                </tr>
                                <tr>
                                    <td>Tgl Posting:</td>
                                    <td>{{ date( 'M j, Y', strtotime($iklan->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl Diperbarui:</td>
                                    <td>{{ date( 'M j, Y', strtotime($iklan->updated_at)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="{{ route('iklans.edit', $iklan->id) }}" class="btn btn-primary btn-block">Edit</a>
                            <hr/>
                            <form method="POST" action="{{ route('iklans.destroy', $iklan->id) }}">
                            <input type="submit" value="Hapus" class="btn btn-danger btn-block">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            {{ method_field('DELETE') }}
                            <hr/>
                            <a href="{{ route('iklans.index') }}"
                            class="btn btn-warning btn-block btn-h1-spacing">Kembali</a>
                            </form>
						</div>
					</div>
    </div>
	</div>



  <div class="clearfix"></div>

</div>
@endsection
