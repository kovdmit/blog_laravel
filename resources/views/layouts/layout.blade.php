<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @section('title')
        <title>BizNews - Free News Website Template</title>
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">
    @show

    <!-- Favicon -->
    <link href="{{ asset('assets/front/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">
</head>

<body>
@include('layouts.header')

@yield('content')

@include('layouts.footer')

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets/front/js/main.js') }}"></script>
@yield('script')
</body>
</html>

@if (session()->has('success'))
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            {{ session('error') }}
        </ul>
    </div>
@endif
