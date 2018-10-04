<!--slider menu-->
    <div class="sidebar-menu">
		  	<div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#">
          <span id="logo" ></span>
			      <!--<img id="logo" src="" alt="Logo"/>-->
			  </a> </div>
		    <div class="menu">
		      <ul id="menu" >
		        <li id="menu-home" ><a href="/"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
            @if ( Auth::user()->hasRole('seller'))
            <li><a href="{{ route('iklans.index') }}"><i class="fa fa-list"></i><span>Iklan</span></a></li>
            <li id="menu-academico" ><a href="#"><i class="fa fa-file-text"></i><span>Form</span>
              <span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul id="menu-academico-sub" >
		          	 <li id="menu-academico-boletim" ><a href="{{ route('iklans.create') }}">Buat Iklan Baru</a></li>
		          </ul>
		         </li>
             @endif
             @if (Auth::user()->hasRole('admin'))
		         <li><a href="#"><i class="fa fa-cog"></i><span>Sistem</span>
               <span class="fa fa-angle-right" style="float: right"></span></a>
		         	 <ul id="menu-academico-sub" >
			            <li id="menu-academico-avaliacoes" ><a href="{{ url('category/') }}">Categori</a></li>

			            <li id="menu-academico-boletim" ><a href="{{ url('seller/') }}">Seller</a></li>

                 </ul>
		         </li>
             @endif
		         <li><a href="#"><i class="fa fa-shopping-cart"></i><span>E-Commerce</span>
               <span class="fa fa-angle-right" style="float: right"></span></a>
		         	<ul id="menu-academico-sub" >
			            <li id="menu-academico-avaliacoes" ><a href="{{ url('produk/') }}">Produk</a></li>
			            <li id="menu-academico-boletim" ><a href="{{ url('iklan/favourites') }}">Favorit</a></li>
		             </ul>
		         </li>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
