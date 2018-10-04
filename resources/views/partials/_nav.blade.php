<!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
									 <!-- <a href="index.html"> <h1>Shoppy</h1> -->
									<img id="logo" src="/images/logo.png" class="img-responsive" alt="Logo"/>
								  </a>
							</div>
							<!--search-box-->
								<div class="clearfix"> </div>
						 </div>
						 <div class="header-right">
							<div class="profile_details">
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">
												@if (Auth::user()->image)
												<span class="prfil-img"><img src="{{ asset('images/users/' . Auth::user()->image) }}"
													alt="" width="50px" height="50px"> </span>
												@else
												<span class="prfil-img"><img src="/images/avatar.png" alt="" width="50px" height="50px"> </span>
												@endif
												<div class="user-name">
													<p>{{ Auth::user()->name }}</p>
													@if (Auth::user()->hasRole('Admin'))
													<span>Administrator</span>
													@else
													<span>Seller</span>
													@endif
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>
											</div>
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="{{ route('auth.profil.show', Auth::user()->id) }}"><i class="fa fa-user"></i>Profil</a> </li>
											<li> <a href="{{ route('auth.profil.changePassword') }}"><i class="fa fa-cog"></i>Ganti Password</a>
											<li> <a href="/logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							<div class="clearfix"> </div>
						</div>
				     <div class="clearfix"> </div>
				</div>
<!--heder end here-->
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop();
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });

		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
