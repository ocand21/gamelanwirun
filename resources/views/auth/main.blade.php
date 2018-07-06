@include('partials._head')

  <body>

    @include('partials._message')
    @yield('content')
    @include('partials._footer')


    @include('partials._js')
  </body>
</html>
