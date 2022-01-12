
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>@yield('title','Dashboard') · Mercatodo</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
</head>
<body>

@include('admin.partials.header')

<div class="container-fluid">
    <div class="row">

        @if( Auth()->user()->role == 'admin')
            @include('admin.partials.side-menu')
        @else
            @include('admin.partials.side-menu-standar')
        @endif

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('section','Dashboard')</h1>
{{--                <div class="btn-toolbar mb-2 mb-md-0">--}}
{{--                    <div class="btn-group me-2">--}}
{{--                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>--}}
{{--                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>--}}
{{--                    </div>--}}
{{--                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">--}}
{{--                        <span data-feather="calendar"></span>--}}
{{--                        This week--}}
{{--                    </button>--}}
{{--                </div>--}}
            </div>
            @section('content')

            @show

        </main>
    </div>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/manifest.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
</body>
</html>
