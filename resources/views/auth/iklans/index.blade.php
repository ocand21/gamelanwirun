@extends('main')

@section('title', '| Daftar Iklan')

@section('content')
<div class="inner-block">
  <div class="cols-grids panel-widget">
  <div class="row mb40">
					<div class="col-md-12">
						<div class="blankpage-main img-responsive">
              <h2>Daftar Iklan</h2>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Instrumen</th>
                    <th>Volume</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
            <?php
            $no = 1;
            ?>
            @foreach ($iklans as $iklan)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ substr($iklan->judul, 0, 30) }}{{ strlen($iklan->judul) > 30 ? "..." : "" }}</td>
                    <td>{{ substr($iklan->volume, 0, 20) }}{{ strlen($iklan->volume) > 20 ? "..." : "" }}</td>

                    <td>{{ $iklan->harga }}</td>
                    <td>{{ substr($iklan->deskripsi, 0, 50) }}{{ strlen($iklan->deskripsi) > 50 ? "..." : "" }}</td>
                    <td>
                      <a href="{{ route('iklans.show', $iklan->id) }}"><i class="glyphicon glyphicon-search mysize"></i></a>
                      <a href="{{ route('iklans.edit', $iklan->id) }}"><i class="glyphicon glyphicon-pencil mysize"></i></a>
                    </td>
                  </tr>
                  @endforeach
          </tbody>
    					</table>
              
                </div>
					</div>
    </div>
	</div>



  <div class="clearfix"></div>

</div>
@endsection
