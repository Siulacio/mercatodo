<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Admin dashboard</title>
</head>
<body>

<div class="container">

{{--    @if(session('message'))--}}
{{--        <div class="alert alert-success mt-4">--}}
{{--            {{ session('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="row text-center">--}}
{{--        <div class="col-md-12 mt-4">--}}
{{--            <h3>Admin dashboard</h3>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

<div id="app">
    <user></user>
</div>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/manifest.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
</body>
</html>
