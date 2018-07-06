@extends('main')

@section('title', '| Seller')

@section('content')
<div class="inner-block">


  <div class="typography">
    <!--button-->
		<div class="grid_3 grid_4">
      <a href="{{ route('seller.create') }}" class="btn btn-primary btn-h1-spacing">Tambah Seller</a>
			<div class="page-header">
	       	<h3>Daftar Seller</h3>
	      </div>
	     <div class="bs-example">
		    <table class="table">
		      <thead>
            <tr>
	    							<th>#</th>
                    <th>Gambar</th>
	    							<th>Nama</th>
	    							<th>Alamat</th>
	    							<th>No. Handphone</th>
	    			</tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            ?>
            @foreach ($users as $user)
    							<tr>
    								<td>{{ $no++ }}</td>
                    <td><img src="{{ asset('images/users/' . $user->image) }}" height="100px" width="100px"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->notelp }}</td>
    							</tr>
    							@endforeach
          </tbody>
		    </table>
	     </div>
	  </div>
  <!--buttons-->
  </div>

  <div class="clearfix"></div>

  </div>


</div>
@endsection
