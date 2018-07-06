@extends('main')


@section('title', '| Iklan')

@section('content')

	@section('judulnav', 'Iklan')

    <section class="forms">
		<div class="col-lg-12">
			<a href="{{ route('iklans.create') }}" class="btn btn-primary" style="margin-bottom: 10px">Iklan Baru</a>
			<div class="card" class="table-responsive">

				<div class="card-header d-flex align-items-center">
					<h3 class="h4">Daftar Iklan</h3>
				</div>
				<div class="card-body" align="center">
						<table class="table table-striped table-responsive">
    						<thead>
    							<tr>
	    							<th>#</th>
	    							<th>Nama Instrumen</th>
	    							<th>Lokasi</th>
	    							<th>Jenis</th>
	    							<th>Harga</th>
	    							<th>Deskripsi</th>
	    							<th>Aksi</th>
	    						</tr>
    						</thead>
    						<tbody>
    							@foreach ($iklans as $iklan)
    							<tr>
    								<td>{{ $iklan->id }}</td>
    								<td>{{ substr($iklan->judul, 0, 30) }}{{ strlen($iklan->judul) > 30 ? "..." : "" }}</td>
    								<td>{{ substr($iklan->lokasi, 0, 20) }}{{ strlen($iklan->lokasi) > 20 ? "..." : "" }}</td>
    								<td>{{ $iklan->jenis }}</td>
    								<td>{{ $iklan->harga }}</td>
    								<td>{{ substr($iklan->deskripsi, 0, 50) }}{{ strlen($iklan->deskripsi) > 50 ? "..." : "" }}</td>
    								<td>
    									<a href="{{ route('iklans.show', $iklan->id) }}"><i class="lnr lnr-magnifier"></i></a>
    									<a href="{{ route('iklans.edit', $iklan->id) }}"><i class="fa fa-pencil-square-o"></i></a>
    								</td>
    							</tr>
    							@endforeach
    						</tbody>
    					</table>

		    		<div class="page-item">
						<p>{!! $iklans->links(); !!}</p>
					</div>
				</div>
			</div>


		</div>


	</section>





@endsection
