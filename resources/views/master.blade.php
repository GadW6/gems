<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" sizes="16" href="{{ asset('/storage/icons/gems-logo.png') }}">

  <title>{{ $page_title ?? 'GEMS' }}</title>
  <meta name="description" content="GEMS Eshop store jewelry diamond precious stones">
  <link rel="stylesheet" href="{{ asset('/css/alertify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/alertify_theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/fade.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/slide.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/nav.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

  <!--Replace with your tailwind.css once created-->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

  @yield('cssdependancy')
</head>

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal relative">


  @yield('body')
 

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="{{ asset('/js/alertify.min.js') }}"></script>
  @if ( Session::has('sm') )
    <script>
      alertify.success("{{ Session::get('sm') }}", 3);
    </script>
  @endif
  <script src="{{ asset('/js/main.js') }}"></script>
  @yield('jsdependancy')
</body>

</html>