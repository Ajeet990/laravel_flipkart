<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('bootstrap_css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('custom_css/custom_style.css') }}" rel="stylesheet">
    <link href="{{ asset('toastr/toastr.css') }}" rel="stylesheet">
    <title>Flpkart</title>
</head>
<body>
    @include('admin/inc/header')
    <div class="content">
        @yield('content')
    </div>
    @include('admin/inc/footer')
</body>
</html>