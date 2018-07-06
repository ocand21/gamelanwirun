@extends('main')


@section('title', '| Detail Iklan')

@section('content')

    @section('judulnav', 'Detail Iklan')

    <section class="forms">
        <div class="row">
		<div class="col-lg-7" style="margin-left: 30px">
			<div class="card" class="table-responsive">

				<div class="card-header d-flex align-items-center">
					<h3 class="h4">{{ $iklan->judul }}</h3>
				</div>
				<div class="card-body" align="center">
						<table class="table">
    						<tbody>
                                <tr>
                                    <th>Gambar</th>
                                    <td><img src="{{ asset('images/' . $iklan->image) }}" class="table-responsive"></td>
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

    						</tbody>
    					</table>
				</div>
			</div>

		</div>

        <div class="col-lg-4">
            <div class="card" style="height: 500px" class="table-responsive">

                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Aksi</h3>
                </div>
                <div class="card-body" align="center">
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
                            <input type="submit" value="Hapus" class="btn btn-danger btn-block"> <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('DELETE') }}
                            <hr/>
                            <a href="{{ route('iklans.index') }}" class="btn btn-warning btn-block btn-h1-spacing">Kembali</a>
                            </form>
                </div>
            </div>

        </div>
        </div>


	</section>





@endsection
