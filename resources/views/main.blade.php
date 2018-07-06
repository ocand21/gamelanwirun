@include('partials._head')
  <body>
    <div class="page-container">
      <div class="left-content">
        <div class="mother-grid-inner">
          @include('partials._nav')
          @include('partials._message')
          @yield('content')
          @include('partials._footer')
        </div>
      </div>

      @include('partials._sidebar')
    </div>

@include('partials._js')
  </body>
</html>
