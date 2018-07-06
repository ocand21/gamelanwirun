@extends('main')

@section('title', '| Iklan')

@section('content')
<div class="inner-block">
  <div class="product-block">
    	<div class="pro-head">
    		<h2>Products</h2>
    	</div>
      @foreach($iklans as $iklan)
    	<div class="col-md-3 product-grid">
    		<div class="product-items">
	    	  <div class="project-eff">
        		<div id="nivo-lightbox-demo"> <p> <a href="{{ asset('images/iklans/' . $iklan->image1) }}"data-lightbox-gallery="gallery1" id="nivo-lightbox-demo"><span class="rollover1"> </span> </a></p></div>
						<img class="img-responsive" src="{{ asset('images/iklans/' . $iklan->image1) }}" alt="">
          </div>
	    		<div class="produ-cost">
	    			<h4>{{ $iklan->judul }}</h4>
	    			<h5>Rp. {{ $iklan->harga }}</h5>
            <div class="clearfix"></div>
            <a href="{{ url('produk/'.$iklan->url) }}" class="btn btn-block btn-default">Detail</a>
	    		</div>
    		</div>
    	</div>
      @endforeach
    	<div class="clearfix"> </div>
    </div>


  <div class="clearfix"></div>

</div>
<link rel="stylesheet" type="text/css" href="/css/magnific-popup.css">
			<script type="text/javascript" src="/js/nivo-lightbox.min.js"></script>
				<script type="text/javascript">
				$(document).ready(function(){
				    $('#nivo-lightbox-demo a').nivoLightbox({ effect: 'fade' });
				});
				</script>

@endsection
