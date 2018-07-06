@extends('main')

@section('title', '| Dashboard')

@section('content')
<div class="inner-block">
  <div class="cols-grids panel-widget">
  <div class="row mb40">
					<div class="col-lg-12">
						<div class="blankpage-main">
              <h2>Kategori</h2>

            <div class="row">
              <div class="col-md-8">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Nama</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td><img src="{{ asset('images/' . $category->image) }}" height="48px" width="48px"></td>
                      <td>{{ $category->name }}</td>
                      <td><form method="POST" action="{{ route('category.destroy', $category->id) }}">
                      <input type="submit" value="Hapus" class="btn btn-danger btn-block"> <input type="hidden" name="_token" value="{{ Session::token() }}"> {{ method_field('DELETE') }}
                      </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="col-md-4">
                <form class="com-mail" action="{{ route('category.store') }}" method='POST' enctype="multipart/form-data">
                  <div class="form-group">
          					<label>Image</label>
                    <input type="file" class="form-control" name="image">
          				</div>
                  <div class="form-group">
      							<label>Kategori</label>
      							<input type="text" class="form-control" name="name">
      						</div>
                  <button type="submit" class="btn btn-outline btn-info">Tambah</button>
    							<input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
              </div>
            </div>

            </div>
					</div>

    </div>
    </div>
	</div>



  <div class="clearfix"></div>

</div>
@endsection
