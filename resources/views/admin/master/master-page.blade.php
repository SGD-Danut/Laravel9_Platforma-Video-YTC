<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('head-title')</title>
    <link rel="stylesheet" href="/bootstrap-5.2.2/css/bootstrap.min.css">
</head>
<body>
    @include('admin.master.parts.top-nav')
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-6 fw-bold">@yield('big-title')</h1>
        <div class="col-lg-10 mx-auto">
            <br>
            @yield('content')
        </div>
    </div>
    <script src="/bootstrap-5.2.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
