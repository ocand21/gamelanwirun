@include('partials._head')

  <body>
  <div class="page home-page">
    @include('partials._nav')

      <div class="page-content d-flex align-items-stretch">
        @include('partials._sidenav')
        
        <div class="content-inner">
          

          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">@yield('judulnav')</h2>
            </div>
          </header>
          @include('partials._message')
          @yield('content')

          @include('partials._footer')

        </div>
      </div>
    </div>
    
    @include('partials._js')

  </body>
</html>