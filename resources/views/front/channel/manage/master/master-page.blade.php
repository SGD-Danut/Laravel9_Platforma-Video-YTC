<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('head-title')</title>
    <link rel="stylesheet" href="/bootstrap-5.2.2/css/bootstrap.min.css">
    <link href="\fontawesome-free-6.2.1-web\css\fontawesome.css" rel="stylesheet">
    <link href="\fontawesome-free-6.2.1-web\css\brands.css" rel="stylesheet">
    <link href="\fontawesome-free-6.2.1-web\css\solid.css" rel="stylesheet">
</head>
<body>
    @include('front.channel.manage.parts.top-nav')
    @yield('content')
    @yield('image-preview-script')
    <script src="/bootstrap-5.2.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>