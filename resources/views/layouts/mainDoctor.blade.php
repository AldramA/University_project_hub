<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'University Project Hub')</title>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
  @auth('doctor')


    @include('layouts.components.doctorNavbar')

    @yield('content')

  @else
    <div class="unauthenticated">
      "Unauthorized,please login to access this page"
    </div>
  @endauth
</body>

</html>
