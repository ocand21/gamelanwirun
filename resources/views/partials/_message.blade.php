@if(Session::has('flash_message'))
<div class="alert alert-success alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
           {!! session('flash_message') !!}
</div>
@endif

@if(Session::has('flash_error'))
<div class="alert alert-danger alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
           {!! session('flash_error') !!}
</div>
@endif

@if(count($errors) > 0)
	<div class="alert alert-danger" role="alert">
		<strong>Errors:</strong>
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>

@endif
