<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @yield('bootstrap')
  <link type="images/png" rel="icon" href="/images/icons8-youtube.png">
  <link href="\fontawesome-free-6.2.1-web\css\fontawesome.css" rel="stylesheet">
  <link href="\fontawesome-free-6.2.1-web\css\brands.css" rel="stylesheet">
  <link href="\fontawesome-free-6.2.1-web\css\solid.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
  @yield('current-video-css')
  @yield('custom-css')
  @yield('playlist-page-style')
  @yield('history-page-style')
  <title>@yield('head-title')</title>
  @livewireStyles
</head>
<body>
  @include('front.master.parts.header')
  @include('front.master.parts.nav')
  @yield('content')
  {{-- Script-uri: --}}
  <script src="/bootstrap-5.2.2/js/bootstrap.bundle.min.js"></script>
  <script src="/js/main.js" charset="utf-8"></script>
  @yield('image-preview-script')
  @yield('share-video-modal-script')
  @yield('save-video-modal-script')
  @livewireScripts
</body>
</html>