@extends('main')


@section('title', "|  $iklan->judul")

@section('content')

    @section('judulnav', '$iklan->judul')

    <section class="forms">
        <div class="col-lg-12" style="margin-left: 30px">
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
                                    <th>No Handphone</th>
                                    <td>{{ $iklan->notelp }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>{{ $iklan->harga }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $iklan->deskripsi }}</td>
                                </tr>
    						</tbody>
    					</table>
				</div>
			</div>

		</div>
	</section>

	



@endsection