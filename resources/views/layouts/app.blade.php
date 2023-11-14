<!DOCTYPE html>
<html lang="en">
@include('dashboard/head')

<body>
    @include('layouts/topbar')
    <div class="container-scroller">

        @yield('content')

      </div>
    @include('dashboard/footer')
    @include('dashboard/js')
</body>
</html>
