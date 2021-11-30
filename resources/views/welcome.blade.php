<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    {{-- <link rel="shortcut icon" type="image/png" href="/icon.png" /> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=&v=weekly"></script> --}}
    <title>Weather App</title>
  </head>
  <body>
      <div id="app">
       <weather-app></weather-app>
    </div>

    <script src="{{ asset("js/app.js") }}"></script>
  </body>
</html>